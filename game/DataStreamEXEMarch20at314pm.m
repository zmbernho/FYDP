function [ ] = DataStreamEXE( )
a2 = 310/1000;
a4 = 375/1000;

% Position board data
board_type_position = 'stroke_rehab_usb'; % use a Q8 card
board_identifier_position = '0';          % use the first Q8 card in the system
channels_position = 0:1;                  % encoder channels 0 to 3

try
    % Initialize encoder position
    board_position = hil_open(board_type_position, board_identifier_position);
    hil_set_encoder_counts(board_position, [1 0], [0 0]);
    counts = hil_read_encoder(board_position, channels_position);
    q = counts*(-2*pi/4000)/(307/16)+[(-5*pi/180-0.0239886591623908) (132*pi/180-0.0422144228549514)]';
    x0 = a2*cos(q(1)) + a4*cos(q(2));
    y0 = a2*sin(q(1)) + a4*sin(q(2));
    
    % Read in Range and ForceMax values from SQL (using 'fetch(conn,sqlquery)') or text
    
%     conn =  database('Mozart_Data','root','','mysql.jdbc.driver.mysqlDriver','jdbc:mysql:oci7:');
%     sqlquery = 'SELECT RANGE_MAX_X, RANGE_MIN_X, RANGE_MAX_Y, RANGE_MIN_Y, GAME_FORCE FROM PATIENT_DATA_GAME where GAME_DATE =( SELECT MAX(GAME_DATE) FROM PATIENT_DATA_GAME WHERE PATIENT_ID = (SELECT PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0) ) AND PATIENT_ID = (SELECT PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0)';
%     results = fetch(conn,sqlquery);
    xMin = -10; xMax = 10;
    yMin = -10; yMax = -2;
    ForceMax = 10;
    
%     X = [ xMin xMin xMax xMax xMin ];
%     Y = [ yMin yMax yMax yMin yMin ];
    
while 1
        % NOTE
        % Global frame is x+ (down) // y+ > // z+ o
        % Read Position in global frame
        counts = hil_read_encoder(board_position, channels_position);
        q = counts*(-2*pi/4000)/(307/16)+[(-5*pi/180-0.0239886591623908) (132*pi/180-0.0422144228549514)]';
        x_c = (a2* cos(q(1)) + a4*cos(q(2)) - x0)*100;
        y_c = (a2* sin(q(1)) + a4*sin(q(2)) - y0)*100;
        
        % Write x y to text
        fid = fopen( 'DataStream.txt', 'wt' );
        fprintf( fid, '%4.4f,%4.4f', x_c, y_c);
        fclose(fid);
        
        CurrentMax = 1.5;
        OuterRange = 10;     %cm
        
        % Setting intended position to put back in range
        if x_c < xMin
            x_f = xMin;
        elseif x_c > xMax
            x_f = xMax;
        else
            x_f = x_c;
        end
        if y_c < yMin
            y_f = yMin;
        elseif y_c > yMax
            y_f = yMax;
        else
            y_f = y_c;
        end
        
        % Setting relative position b/w current and intended
        x_r = x_f - x_c;
        y_r = y_f - y_c;

        % Array format
        pos_c = [ x_c; y_c ];               % current position
        pos_f = [ x_f; y_f ];               % final position
        pos_r = pos_f - pos_c;              % relative position
        
        if norm(pos_r) == 0
            pos_r_u = [ 0; 0 ];
        else
            pos_r_u = (pos_r./norm(pos_r)); % relative position unit vector
        end
        
        Force = pos_r_u*ForceMax*min(1,max(0,norm(pos_r)/OuterRange));
        J = [-a2*sin(q(1)), a4*sin(q(2)); a2*cos(q(1)), a4*cos(q(2))];
        Torque = transpose(J)*[ Force(2); -Force(1) ];
        Torque = Torque./(307/16);
        Current = Torque./115e-3;
        Current = [ min(CurrentMax, max(-CurrentMax, Current(1))); min(CurrentMax, max(-CurrentMax, Current(2))) ]; %clamping fn
        
        hil_write_analog(board_position, [1 0], Current);
end
catch err
    hil_close_all;
    board_position = hil_open(board_type_position, board_identifier_position);
    hil_write_analog(board_position, [1 0], [0; 0]);
    hil_task_stop_all(board_position);
    hil_task_delete_all(board_position);
    hil_close(board_position);
    hil_close_all;
    rethrow(err);
end
end
    