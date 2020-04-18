<?php
class sanitizationProcess{
        # BLacklisted IP's of errors
        private $blacklist = array();

        function handle_xss($user_input){
            $user_input = htmlspecialchars(stripslashes(trim($user_input)));
            return $user_input; 
        }


        function handle_sqli($inp){
            # ( https://www.php.net/mysql_real_escape_string ) Taken from this thread, simple function to handle some basic ...
            # Sqli function does the rest of it, ( https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php )
                if(is_array($inp))
                    return array_map(__METHOD__, $inp);
            
                if(!empty($inp) && is_string($inp)) {
                    return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
                }
            
                return $inp;
        }

        function blockHacker(){
            /*
            There are various things which you could do to block the hacker, but the simplest is to terminate the session and kill,
            and then redirect the hacker to an error page, 
            You could do other cool things with iptables or WAFS

            */


            if($this->get_hackers_ip_method1() == $this->get_hackers_ip_method2()){
                array_push($blacklist,$this->get_hackers_ip_method1());
                header("Location: blocked.php");
                die();
            }
            else{
                array_push($blacklist,$this->get_hackers_ip_method1(),$this->get_hackers_ip_method2());
                header("Location: blocked.php");
                die();
            }
        }



        function get_hackers_ip_method1(){
            # Many times it happens that the client address is different from what we get, this can be solved bny using various getenv
            # Thus two different methods have been implemented for this.

            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            
            $ipaddress1 = $ipaddress;
            return $ipaddress1;
        }
        function get_hackers_ip_method2(){
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            $ipaddress2 = $ipaddress;
            return $ipaddress2;

        }

        function sanity_check($user_input){
            if(preg_match("/(\b)(on\S+)(\s*)=|javascript|(<\s*)(\/*)script/",$user_input)){
                # Hacker Detected, Block him !!!!
                $this->handle_xss($user_input);
                $this->blockHacker();
            }
            else{
                # Sanitize everything :)
                $user_input = $this->handle_xss($user_input);
                $user_input = $this->handle_sqli($user_input);
                return $user_input; # Now the user input is safe for further processing.
            }
        }

    } // class SanitizationProcess Ends 
?>