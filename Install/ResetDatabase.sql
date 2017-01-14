/**
 * Script to reset the complete database.
 */

# Disable foreign keys so we can truncate all tables without restrictions.
SET FOREIGN_KEY_CHECKS=0;

# Reset the tables.
TRUNCATE TABLE `DigitalPortfolio`.`GuestBookMessage`;
TRUNCATE TABLE `DigitalPortfolio`.`Teacher`;
TRUNCATE TABLE `DigitalPortfolio`.`Student`;
TRUNCATE TABLE `DigitalPortfolio`.`User`;
TRUNCATE TABLE `DigitalPortfolio`.`Image`;
TRUNCATE TABLE `DigitalPortfolio`.`Portfolio`;
TRUNCATE TABLE `DigitalPortfolio`.`Project`;
TRUNCATE TABLE `DigitalPortfolio`.`Page`;
TRUNCATE TABLE `DigitalPortfolio`.`Theme`;
TRUNCATE TABLE `DigitalPortfolio`.`Skill`;
TRUNCATE TABLE `DigitalPortfolio`.`Training`;
TRUNCATE TABLE `DigitalPortfolio`.`Hobby`;
TRUNCATE TABLE `DigitalPortfolio`.`Language`;
TRUNCATE TABLE `DigitalPortfolio`.`JobExperience`;

# Enable it again.
SET FOREIGN_KEY_CHECKS=1;