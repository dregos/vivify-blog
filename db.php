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
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
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
    return $this->conn->lastInsertId();
    //return $statement->fetch();
  }

  public function getArticleById($articleId){

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
  public function createArticle($data){

    $user_id = $data['user_id'];
    //$article_id = $data['article_id'];
    $article_title = $data['title'];
    $article_text = $data['text'];
    $category_id = $data['category_id'];


    $insertQuery = "INSERT INTO articles (title, text, user_id, category_id)
                    VALUES ('$article_title', '$article_text', '$user_id', '$category_id')";

    $response = $this->executeQuery($insertQuery);
    return $response;
  }
  public function updateArticle($article){

    $sqlUpdateArticle = "UPDATE articles SET
                          title = \"{$article->title}\",
                          text = \"{$article->text}\",
                          category_id = ".$article->category->getId().",
                          user_id = ".$article->user->getId()."
                          WHERE articles.id = ". $article->getId();
    //$this->log->writeLog($sqlUpdateArticle, null);
    $this->executeQuery($sqlUpdateArticle);
  }
  public function deleteArticle($id){
    $sql = "DELETE FROM articles WHERE id=$id";
    $this->executeQuery($sql);
  }


  public function createComment($data){

    $user_id = $data['user_id'];
    $article_id = $data['article_id'];
    $comment_text = $data['text'];

    $insertCommentQuery = "INSERT INTO comments (text, user_id, article_id)
                            VALUES ('$comment_text', '$user_id', $article_id)";

    $response = $this->executeQuery($insertCommentQuery);
    return $response;
  }

  public function getAllCategories(){
    $sql = "SELECT categories.id , categories.name as category_name FROM categories";
    $records = $this->fetchData($sql);
    foreach($records as $category){
      $categories[] = new Category($this, $category["id"]);
    }
    return $categories;
  }

  public function getAllUserArticles($user){
    $sql = "SELECT articles.user_id as user_id, articles.id as article_id, articles.title as title,
                   articles.text, articles.created as created, articles.category_id as category_id
    FROM articles
    WHERE user_id=".$user->getId()." ORDER BY created DESC";
    $records = $this->fetchData($sql);
    //var_dump($records);

    foreach($records as $article){
      $articles[] = new Article($this, $article);
    }
    return $articles;
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
    return $date;
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
                    comments.created,
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


  public function returnHTML(){
    echo("<header class=\"comment-header\">");
      echo("<author>".$this->getAuthor()->getFullName()."</author>");
      echo("<date class=\"tooltip\">");
        echo($this->getCreatedDate()->format('H:i'));
        echo("<span class=\"tooltiptext\">".$this->getCreatedDate()->format('d.m.Y H:i')."</span>");
      echo("</date>");
    echo("</header>");
    echo("<content");
      echo("<p>".$this->getText()."</p>");
    echo("</content>");
  }
}

class User{
  private $user_id;
  private $user_email;
  private $first_name;
  private $last_name;
  private $db;

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
      WHERE article_id=".$this->getId(). " ORDER BY created DESC";

    $records = $this->db->fetchData($sql);

    foreach($records as $val){
      $this->comments[] = new Comment($this->db, $val["id"]);
    }
  }

  public function __construct($db, $record){
    $this->db = isset($db) ? $db:new Db($log);
    $this->setId(isset($record["id"]) ? $record["id"]:"");
    if($this->getId()==""){ $this->setId(isset($record["article_id"]) ? $record["article_id"]:""); }
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
