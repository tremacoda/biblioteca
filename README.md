# tremacoda
biblioteca
CREATE TABLE 'login'( 'id' INT ( 5 ) NOT NULL AUTO_INCREMENT,'user' VARCHAR(40) NOT NULL,'password' VARCHAR(64) NOT NULL,PRIMARY KEY ('id'))


CREATE TABLE IF NOT EXISTS "utenti" (
      'id' int(11) NOT NULL AUTO INCREMENT,
      'nome' varchar(255) NOT NULL,
      'cognome' varchar(255) NOT NULL,
      'email' varchar(255) NOT NULL,
      'anno_nascita' year(4) NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;