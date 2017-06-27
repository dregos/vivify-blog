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
