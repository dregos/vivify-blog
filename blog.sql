UPDATE user_profiles
SET first_name = "Mika", last_name = "Mikić" WHERE user_id=2;
UPDATE user_profiles
SET first_name = "Žika", last_name = "Žikić" WHERE user_id=3;
UPDATE user_profiles
SET first_name = "Marko", last_name = "Marković" WHERE user_id=4;
SELECT * from user_profiles;
select * from users;


UPDATE articles
SET category_id = 3
WHERE articles.id=6;
select * from articles;


ALTER TABLE comments
ADD created DATETIME DEFAULT CURRENT_TIMESTAMP;

INSERT INTO comments (text, user_id, article_id)
VALUES
	("Ovo je jako interesantno",1,1),
	("Ovo je jako super",2,1),
	("Ma nemaš pojma",3,1);

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
