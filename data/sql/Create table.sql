/* 
 * Yanni Wijaya (YanniWijaya.com)
 * @copyright Copyright (c) 2016 Yanni Wijaya
 * @mail yanni.wijaya@gmail.com, yanni.wijaya@pln.co.id
 */
/**
 * Author:  yanni.wijaya
 * Created: Jun 22, 2016
 */

CREATE TABLE pegawai (
   id int(11) NOT NULL auto_increment,
   nama varchar(100) NOT NULL,
   nip varchar(100) NOT NULL,
   PRIMARY KEY (id)
 );
 INSERT INTO pegawai (nama, nip)
     VALUES  ('Ahmad',  '851112Z');
 INSERT INTO pegawai (nama, nip)
     VALUES  ('Badu',  '861113Z');
 INSERT INTO pegawai (nama, nip)
     VALUES  ('Ali',  '871114Z');
 INSERT INTO pegawai (nama, nip)
     VALUES  ('Iman',  '881115Z');
 INSERT INTO pegawai (nama, nip)
     VALUES  ('Hasan',  '891116Z');