<?php include 'log.php' ?>
<?php
session_start();


class Db{
  private $servername = "127.0.0.1";
  private $username = "root";
  private $password = "vivify";
  private $dbname = "vivify_oglasnik";
  public $conn;
  public $error = "";
  public $log;

  public function __construct($logObj){
    try {

        $this->log = isset($logObj)? $logObj : new Log();
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
      $this->error = $e->getMessage();
      //die();
    }
  }

  public function fetchData($query){
     //echo ($sql);
    $statement = $this->conn->prepare($query);
    // execute statement
    $statement->execute();
    // set the resulting array to associative
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    // gets data from DB
    return $statement->fetchAll();
  }

  public function executeQuery($query){
    //echo ($sql);
    $statement = $this->conn->prepare($query);
    // execute statement
    $statement->execute();
    return true;
  }

  public function getArticleById($articleId){
    /*$sql = "SELECT ads.id, ads.title, ads.text, ads.created_at, ads.expires_on,categories.id as category_id,
      categories.name AS category_name, users.id AS user_id,users.email AS email,
      profiles.first_name, profiles.last_name, profiles.city, profiles.phone FROM ads
      LEFT JOIN categories ON categories.id = ads.category_id
      LEFT JOIN users ON users.id = ads.user_id
      LEFT JOIN profiles ON profiles.user_id = users.id WHERE ads.id = $adId";

      public $title;
      public $text;
      public $created;
      public $last_modified;
      public $user;
      public $category;
    */
    $sql = "SELECT articles.id, articles.title, articles.text, articles.created, articles.last_modified,
    articles.user_id as user_id, articles.category_id as category_id
    FROM articles
    WHERE articles.id =$articleId";
    //var_dump($sql);
    $retVal = $this->fetchData($sql);
    //echo("article/retVal:");
    //var_dump($retVal);
    if(empty($retVal)){ return null; }
    $articleObj = new Article($this, $retVal[0]);
    return $articleObj;
  }

  public function updateArticle($article){
    //$this->log->writeLog("ad_id:$ad->ad_id", null);
    //$this->log->writeLog("category_id:$ad->category_id", null);
    //$sqlUpdateArticle = "UPDATE ads SET title = '{$article->title}', text = '{$article->text}', category_id = $article->category_id WHERE ads.id = $article->ad_id";
    //$this->log->writeLog("Update query:$updateAdQuery", null);
    //$this->executeQuery($sqlUpdateAd);
  }

  public function createAd($ad){
    $sqlCreateAd = "INSERT INTO ads (ads.title, ads.text) VALUES ('{$ad->title}', '{$ad->text}', '')";
  }

  public function getAllCategories(){
    $sql = "SELECT categories.id as category_id, categories.name as category_name FROM categories";
    $this->fetchData($sql);
  }

}

class Category{
  private $id;
  private $name;

  public function setId($id){ $this->id = $id; }
  public function setName($name){ $this->name = $name; }
  public function getId(){ return $this->id; }
  public function getName(){ return $this->name; }

  public function __construct($db, $category_id){
    $this->db = isset($db) ? $db:new Db($log);
    if(!isset($category_id) || $category_id==""){return null; }

    $sql = "SELECT categories.id, categories.name
              FROM categories
              WHERE categories.id=$category_id";
    $record = $db->fetchData($sql);
    //var_dump($record);
    $this->setId($record[0]["id"]);
    $this->setName($record[0]["name"]);
  }

}

class Comment{
  private $id;
  private $author;
  private $text;
  private $article;
  public $created;
  public $db;

  public function setDb($db){ $this->db = $db; }
  public function setId($id){ $this->id = $id; }
  public function setText($text){ $this->text = $text; }
  public function getText(){ return $this->text; }
  public function getCreatedDate(){
    $date = date_create($this->created);
    return $date->format('d.m.Y');
  }

  public function setAuthor($user_id){
    $this->author = new User($this->db, $user_id);
  }
  public function getAuthor(){ return $this->author; }

  public function setArticle($article_id){
    $this->article = new Article($this->db, $article_id);
  }
  public function getArticle(){ return $this->article; }

  public function __construct($db, $comment_id){
    $this->db = isset($db) ? $db:new Db($log);
    if(!isset($comment_id) || $comment_id==""){return null; }

    $sql = "SELECT comments.id, comments.text,
                    comments.user_id as user_id,
                    comments.article_id as article_id
              FROM comments
              WHERE comments.id=$comment_id";
    $record = $db->fetchData($sql);
    //var_dump($record);
    $this->setId($record[0]["id"]);
    $this->setText($record[0]["text"]);
    $this->created = isset($record[0]["created"]) ? $record[0]["created"]:"";
    $this->setAuthor($record[0]["user_id"]);
    //$this->setArticle($record[0]["article_id"]);
  }

}

class User{
  private $user_id;
  private $user_email;
  private $first_name;
  private $last_name;


  public function setUserId($user_id){ $this->user_id = $user_id; }
  public function setUserEmail($email){ $this->email = $email; }
  public function setName($first_name, $last_name){
    $this->first_name = $first_name;
    $this->last_name = $last_name;
  }
  public function getId(){ return $this->user_id; }
  public function getEmail(){ return $this->email; }
  public function getFullName(){
    return $this->first_name . " " . $this->last_name; }

  public function __construct($db,$user_id){
    $this->db = isset($db) ? $db:new Db($log);
    $sql = "SELECT users.id, users.email,
                    user_profiles.first_name as first_name,
                    user_profiles.last_name as last_name
                    FROM users
                    LEFT JOIN user_profiles ON user_id = users.id
                    WHERE users.id=".$user_id;


    $record = $db->fetchData($sql);
    //echo("User record:");
    //var_dump($record);
    $this->setUserId($record[0]["id"]);
    $this->setUserEmail($record[0]["email"]);
    $this->setName($record[0]["first_name"], $record[0]["last_name"]);
  }

}

class Article{
  private $id;
  public $title;
  public $text;
  public $created;
  public $last_modified;
  public $user;
  public $category;
  public $db;
  private $comments = [];

  public function setId($id){ $this->id = $id; }
  public function getId(){ return $this->id; }

  public function getAuthor(){ return $this->user->getFullName(); }
  public function getCreatedDate(){
    $date = date_create($this->created);
    return $date->format('d.m.Y');
  }

  public function getArticleComments(){
    return $this->comments;
  }

  public function setArticleComments(){
    $sql = "SELECT comments.id, comments.text, comments.created, comments.user_id,
                  comments.article_id as article_id
    FROM comments
    WHERE article_id=".$this->getId();

    $records = $this->db->fetchData($sql);

    foreach($records as $val){
      $this->comments[] = new Comment($this->db, $val["id"]);
    }
  }

  public function __construct($db, $record){
    $this->db = isset($db) ? $db:new Db($log);
    $this->setId(isset($record["id"]) ? $record["id"]:"");
    $this->title = isset($record["title"]) ? $record["title"]:"";
    $this->text = isset($record["text"]) ? $record["text"]:"";
    $this->created = isset($record["created"]) ? $record["created"]:"";
    $this->last_modified = isset($record["last_modified"]) ? $record["last_modified"]:"";

    $this->user = new User($db, isset($record["user_id"]) ? $record["user_id"]:"");

    $this->category = new Category($db, isset($record["category_id"]) ? $record["category_id"]:"");

    $this->setArticleComments();
  }
}

$log = new Log();

try{
  $dbBlog = new Db($log);
  if($dbBlog->error!=""){
    echo($dbBlog->error);
    $log->writeLog($dbBlog->error, null);
    return false;
  }
}catch(Exception $ex){
  $log->writeLog($ex->getMessage, $ex->getLine());
}


?>
