<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180402022854 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id_increment INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, image TEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id_increment INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX fk_category_category1_idx (category_id), UNIQUE INDEX code_UNIQUE (code), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, slug VARCHAR(100) NOT NULL, group_rol VARCHAR(100) DEFAULT NULL, group_rol_tag VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE route (id_increment INT AUTO_INCREMENT NOT NULL, route_id INT DEFAULT NULL, distrit_from INT DEFAULT NULL, distrit_to INT DEFAULT NULL, status VARCHAR(45) DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, slug VARCHAR(100) NOT NULL, latitude_start NUMERIC(11, 8) DEFAULT NULL, longitude_start NUMERIC(11, 8) DEFAULT NULL, latitude_end NUMERIC(11, 8) DEFAULT NULL, longitude_end NUMERIC(11, 8) DEFAULT NULL, description TEXT DEFAULT NULL, nro_of_seats VARCHAR(11) DEFAULT NULL, telephone TINYTEXT DEFAULT NULL, precio_por_hora TINYTEXT DEFAULT NULL, image TEXT DEFAULT NULL, created_at DATETIME NOT NULL, time_start TIME DEFAULT NULL, time_end TIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX IDX_2C4207989DC639D (distrit_from), INDEX IDX_2C420793695BE43 (distrit_to), INDEX fk_route_route1_idx (route_id), UNIQUE INDEX code_UNIQUE (code), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_has_role (profile_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_F35F3084CCFA12B8 (profile_id), INDEX IDX_F35F3084D60322AC (role_id), PRIMARY KEY(profile_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id_increment INT AUTO_INCREMENT NOT NULL, route_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, inicio DATETIME DEFAULT NULL, fin DATETIME DEFAULT NULL, time VARCHAR(80) DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, user_id VARCHAR(11) DEFAULT NULL, INDEX fk_reserva_route1_idx (route_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_has_product (id_increment INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, product_id INT DEFAULT NULL, stock INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX fk_category_has_product_product1_idx (product_id), INDEX fk_category_has_product_category1_idx (category_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distrit (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id_increment INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(45) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D044D5D4A76ED395 (user_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', client_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, plate VARCHAR(255) DEFAULT NULL, is_auto TINYINT(1) NOT NULL, slug VARCHAR(255) DEFAULT NULL, device_code VARCHAR(100) DEFAULT NULL, dni VARCHAR(8) DEFAULT NULL, name VARCHAR(100) NOT NULL, last_name VARCHAR(100) DEFAULT NULL, dob DATE DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, phone VARCHAR(45) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, last_access DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX FK_8D93D649CCFA12B8 (profile_id), UNIQUE INDEX email_UNIQUE (email), UNIQUE INDEX username_UNIQUE (username), UNIQUE INDEX dni_UNIQUE (dni), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_route (user_id INT NOT NULL, route_id INT NOT NULL, INDEX IDX_F9ADBD23A76ED395 (user_id), INDEX IDX_F9ADBD2334ECB4E6 (route_id), PRIMARY KEY(user_id, route_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C112469DE2 FOREIGN KEY (category_id) REFERENCES category (id_increment)');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C4207934ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id_increment)');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C4207989DC639D FOREIGN KEY (distrit_from) REFERENCES distrit (id)');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C420793695BE43 FOREIGN KEY (distrit_to) REFERENCES distrit (id)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084D60322AC FOREIGN KEY (role_id) REFERENCES role (id_increment)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B34ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id_increment)');
        $this->addSql('ALTER TABLE category_has_product ADD CONSTRAINT FK_3202E1D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id_increment)');
        $this->addSql('ALTER TABLE category_has_product ADD CONSTRAINT FK_3202E1D4584665A FOREIGN KEY (product_id) REFERENCES product (id_increment)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE user_has_route ADD CONSTRAINT FK_F9ADBD23A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_route ADD CONSTRAINT FK_F9ADBD2334ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id_increment)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_has_product DROP FOREIGN KEY FK_3202E1D4584665A');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C112469DE2');
        $this->addSql('ALTER TABLE category_has_product DROP FOREIGN KEY FK_3202E1D12469DE2');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084D60322AC');
        $this->addSql('ALTER TABLE route DROP FOREIGN KEY FK_2C4207934ECB4E6');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B34ECB4E6');
        $this->addSql('ALTER TABLE user_has_route DROP FOREIGN KEY FK_F9ADBD2334ECB4E6');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084CCFA12B8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE route DROP FOREIGN KEY FK_2C4207989DC639D');
        $this->addSql('ALTER TABLE route DROP FOREIGN KEY FK_2C420793695BE43');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4A76ED395');
        $this->addSql('ALTER TABLE user_has_route DROP FOREIGN KEY FK_F9ADBD23A76ED395');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_has_role');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE category_has_product');
        $this->addSql('DROP TABLE distrit');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_route');
    }
}
