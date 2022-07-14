<?php
    class Log {
        function Log(){
            self::logMsg('DEBUG','Logging started');
        }

        public static function debug($message){
            self::logMsg('DEBUG', $message);
        }

        public static function info($message){
            self::logMsg('INFO', $message);
        }

        public static function error($message){
            self::logMsg('ERROR', $message);
        }

        private static function logMsg($type, $message){
            if(Db::isConnected()){
                /* PREPARE SQL STATEMENT */
                $sql = Db::$connection->prepare("INSERT INTO sys_logs (logged_at,type,pid,ip_address,uid,session,method,path,message) values(NOW(),?,?,?,?,?,?,?,?)");
                if($sql == false){
                    //echo Db::prepareError();
                    return;
                }

                /* SETUP VARIABLES */
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $pid = getmypid();
                $path = (array_key_exists('PATH_INFO', $_SERVER) ? strtolower($_SERVER['PATH_INFO']) : '');
                $method = $_SERVER['REQUEST_METHOD'];

                /* BIND PARAMETERS FOR SQL STATEMENT */
                $sql->bind_param("sissssss", $type,$pid,$ip_address,$uid,$session,$method,$path,$message);

                /* EXECUTE QUERY */
                $status = $sql->execute();
                // if(!$status){
                //     print "EXECUTE ERROR: ".$sql->error;
                // }
            }
        }
    }
?>