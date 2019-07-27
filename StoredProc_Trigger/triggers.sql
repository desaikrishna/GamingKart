CREATE TRIGGER feedback after insert

on `feedback`

for each row

begin

insert into feedback values (rating number(1), feedback varchar2(20));

end