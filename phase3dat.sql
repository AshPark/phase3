create database hw3;
use hw3;

create table Food(
  FID char(10) primary key,
  Quantity integer,
  Price float,
  DatePurchased date,
  ShelfLife integer,
  Name varchar(20)
);

create table Supplier (
  Name varchar(50) primary key,
  Phone integer
);

create table SuppAddr (
  SuppName varchar(50) references Supplier(Name),
  Street varchar(30),
  City varchar(20),
  SuppState char(2),
  Zip integer,
  primary key (SuppName, Street, City, SuppState, Zip)
);

create table Toy (
  TID char(10) primary key,
  Quantity integer,
  Name varchar(20),
  Price float
);

create table Pet(
  PID char(10) primary key,
  Price float,
  Lifetime float
);

create table Pet_Allergens (
  PID char(10) references Pet(PID),
  Allergen varchar(50),
  primary key (PID, Allergen)
);

create table Bird (
  PID char(10) primary key references Pet(PID),
  Flying boolean
);

create table Mammal (
  PID char(10) primary key references Pet(PID),
  HairType varchar(50),
  Caged boolean
);

create table Reptile (
  PID char(10) primary key references Pet(PID),
  NumLegs integer
);

create table Fish (
  PID char(10) primary key references Pet(PID),
  WaterType varchar(5) check (WaterType = 'Fresh' or WaterType = 'Salt')
);  

create table Caretaker (
  PID char(10) references Pet(PID),
  Name varchar(20),
  WeeklyHrs float,
  HomePhone integer,
  WorkPhone integer,
  primary key (PID, Name)
);

create table PlaysWith (
  PID char(10) references Pet(PID),
  TID char(10) references Toy(TID),
  primary key (PID, TID)
);

create table Eats (
  PID char(10) references Pet(PID),
  FID char(10) references Food(FID),
  primary key (PID, FID)
);

create table SuppFood (
  SuppName varchar(50) references Supplier(Name),
  FID char(10) references Food(FID),
  primary key (SuppName, FID)
);

create table SuppPets (
  SuppName varchar(50) references Supplier(Name),
  PID char(10) references Pet(PID),
  primary key (SuppName, PID)
);

create table SuppToys (
  SuppName varchar(50) references Supplier(Name),
  TID char(10) references Toy(TID),
  primary key (SuppName, TID)
);

insert into Food values('FOOD000001', 10, 10.45, '2015-02-28', 10, 'Iams');

insert into Food values('FOOD000002', 4, 15.95, '2015-03-09', 10, 'Kibbles&Bits');

insert into Food values('FOOD000003', 1, 20.00, '2014-12-31', 10, 'Blue');

insert into Food values('FOOD000004', 20, 4.65, '2015-04-27', 10, 'Beggin Strips');

insert into Food values('FOOD000005', 15, 12.34, '2015-01-09', 10, 'Greenies');

insert into Food values('FOOD000010', 4, 30.00, '2015-01-01', 3, 'Nummy Nummies');

insert into Supplier values('Supply All the Pets', 5551111);

insert into SuppAddr values('Supply All the Pets', 'Rainbow Rd.', 'Sunnyville', 'CA', '1234');

insert into Supplier values('Feed All The Pets', 5551234);

insert into Supplier values('Play With All the Toys', 1234567);

insert into Supplier values('Creatures R Us', 3245612);

insert into Supplier values('Nom Nom Noms', 8593957);

insert into Supplier values('Yay Toys', 9323512);

insert into SuppAddr values('Feed All The Pets', 'Ashley Pkwy', 'Ashland', 'MO', '6543');

insert into SuppAddr values('Play With All the Toys', 'Blitzen Ave', 'North Pole', 'Alaska', '1225');

insert into SuppAddr values('Creatures R Us', 'Easy St', 'Little Rock', 'AR', '9865');

insert into SuppAddr values('Nom Nom Noms', 'Speedy Dr', 'Salt Lake City', 'UT', '1234');

insert into SuppAddr values('Yay Toys', 'Vroom Vroom Rd', 'Little Town', 'KY', '1234');

insert into Toy values('TOY0000001', 90, 'Tennis Ball', 3.00);

insert into Toy values('TOY0000002', 50, 'Hamster Wheel', 10.74);

insert into Toy values('TOY0000003', 11, 'Aquarium Plant', 6.82);

insert into Toy values('TOY0000004', 45, 'Bell', 4.54);

insert into Toy values('TOY0000005', 32, 'Rope', 17.00);

insert into Toy values('TOY0000006', 85, 'Rock', 5.00);

insert into Toy values('TOY0000007', 21, 'Perch', 2.00);

insert into Toy values('TOY0000008', 10, 'Kitty Castle', 54.00);

insert into Toy values('TOY0000009', 30, 'Small Pool', 13.87);

insert into Toy values('TOY0000010', 90, 'Tube Maze', 29.99);

insert into Pet values('DOG0000001', 100.00, 10);

insert into Pet values('CAT0000002', 50.99, 14);

insert into Pet values('FISH000001', 3.56, 1);

insert into Pet values('FISH000002', 50.99, 2);

insert into Pet values('SNAKE00001', 14.66, 5);

insert into Pet values('LIZARD0002', 50.99, 14);

insert into Pet values('BIRD000001', 25.93, 7);

insert into Pet values('BIRD000002', 78.43, 20);

insert into Bird values('BIRD000001', 0);

insert into Bird values('BIRD000002', 1);

insert into Mammal values('DOG0000001', 'long', 0);

insert into Mammal values('CAT0000002', 'short', 0);

insert into Fish values('FISH000001', 'Fresh');

insert into Fish values('FISH000002', 'Salt');

insert into Reptile values('SNAKE00001', 0);

insert into Reptile values('LIZARD0002', 4);

insert into Caretaker values('CAT0000002', 'Ashley', 20, 1234567, 7654321);

insert into Caretaker values('BIRD000001', 'Deborah', 30, 9283756, 3029573);

insert into Caretaker values('SNAKE00001', 'Aaron', 30, 3958276, 2049286);

insert into Caretaker values('DOG0000001', 'Billy', 10, 2029492, 2019382);

insert into Caretaker values('BIRD000002', 'Bob', 20, 9485768, 2049684);


insert into PlaysWith values('CAT0000002', 'TOY0000008');

insert into PlaysWith values('DOG0000001', 'TOY0000001');

insert into PlaysWith values('DOG0000001', 'TOY0000008');

insert into PlaysWith values('BIRD000001', 'TOY0000004');

insert into PlaysWith values('BIRD000002', 'TOY0000005');

insert into PlaysWith values('LIZARD0002', 'TOY0000002');

insert into PlaysWith values('FISH000001', 'TOY0000003');

insert into PlaysWith values('SNAKE00001', 'TOY0000009');

insert into PlaysWith values('FISH000002', 'TOY0000006');

insert into Eats values('DOG0000001', 'FOOD000002');

insert into Eats values('CAT0000002', 'FOOD000001');

insert into Eats values('BIRD000002', 'FOOD000005');

insert into Eats values('BIRD000001', 'FOOD000005');

insert into Eats values('FISH000001', 'FOOD000003');

insert into Eats values('FISH000002', 'FOOD000003');

insert into Eats values('SNAKE00001', 'FOOD000004');

insert into Eats values('LIZARD0001', 'FOOD000004');

insert into SuppFood values('Nom Nom Noms', 'FOOD000001');

insert into SuppFood values('Nom Nom Noms', 'FOOD000002');

insert into SuppFood values('Nom Nom Noms', 'FOOD000003');

insert into SuppFood values('Feed All The Pets', 'FOOD000004');

insert into SuppFood values('Feed All The Pets', 'FOOD000005');

insert into SuppPets values('Creatures R Us', 'DOG0000001');

insert into SuppPets values('Creatures R Us', 'CAT0000002');

insert into SuppPets values('Creatures R Us', 'SNAKE00001');

insert into SuppPets values('Creatures R Us', 'LIZARD0002');

insert into SuppPets values('Supply All the Pets', 'FISH000001');

insert into SuppPets values('Supply All the Pets', 'FISH000002');

insert into SuppPets values('Supply All the Pets', 'BIRD000001');

insert into SuppPets values('Supply All the Pets', 'BIRD000002');

insert into SuppToys values('Play With All the Toys', 'TOY0000001');

insert into SuppToys values('Play With All the Toys', 'TOY0000002');

insert into SuppToys values('Play With All the Toys', 'TOY0000003');

insert into SuppToys values('Play With All the Toys', 'TOY0000004');

insert into SuppToys values('Play With All the Toys', 'TOY0000005');

insert into SuppToys values('Yay Toys', 'TOY0000006');

insert into SuppToys values('Yay Toys', 'TOY0000007');

insert into SuppToys values('Yay Toys', 'TOY0000008');

insert into SuppToys values('Yay Toys', 'TOY0000009');

insert into SuppToys values('Yay Toys', 'TOY0000001');

insert into Pet_Allergens values('DOG0000001', 'Dandruff');

insert into Pet_Allergens values('DOG0000001', 'Dander');

insert into Pet_Allergens values('CAT0000001', 'Dandruff');

insert into Pet_Allergens values('BIRD000001', 'Dander');

insert into Pet_Allergens values('BIRD000002', 'Dander');
