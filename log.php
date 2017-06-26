<?php
class Log{
  public $logFile;
  public $fileName;
  public $filePath;
  private $logDirectory = "log/";
  public $user;
  public $timeStamp;

  function __construct(){
    /* inicializiraj log file*/
    //echo("inicializacija Log classa\n");
    $this->fileName = gmdate("Y-m-d",time()). ".log";
    //echo("<br>");
    //var_dump($this->fileName);
    $this->filePath = $this->logDirectory . $this->fileName;
    $this->logFile = fopen($this->filePath, "a+", "w");
    //echo("<br>");
    //var_dump($this->logFile);
  }

  public function writeLog($logMsg, $lineNumber){
    $this->timeStamp = gmdate("Y-m-d H:i:s",time());
    $logMsg = $this->timeStamp . " --> " . $logMsg;
    $logMsg = $lineNumber == null ? $logMsg : $logMsg . " in line $lineNumber.";
    file_put_contents($this->filePath, $logMsg."\n", FILE_APPEND);
  }

  public function closeLog(){
    fclose($this->logFile);
  }
}
?>
