DELIMITER $$

CREATE TRIGGER Before_Insert_User
BEFORE INSERT ON results
FOR EACH ROW
BEGIN
  IF (EXISTS(SELECT 1 FROM User WHERE MatNumber = NEW.MatNumber AND CourseCode = New.CourseCode AND Mark = New.Mark AND Grade = New.Grade)) THEN
    SIGNAL SQLSTATE VALUE '45000' SET MESSAGE_TEXT = 'INSERT failed due to duplicate mobile number';
  END IF;
END$$
DELIMITER ;