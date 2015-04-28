create database Goats;
use Goats;

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

insert into food values('FOOD000001', 10, 10.45, '2015-02-28', 10, 'Iams');

insert into food values('FOOD000002', 4, 15.95, '2015-03-09', 10, 'Kibbles&Bits');

insert into food values('FOOD000003', 1, 20.00, '2014-12-31', 10, 'Blue');

insert into food values('FOOD000004', 20, 4.65, '2015-04-27', 10, 'Beggin Strips');

insert into food values('FOOD000005', 15, 12.34, '2015-01-09', 10, 'Greenies');

insert into supplier values('Supply All the Pets', 5551111);

insert into suppaddr values('Supply All the Pets', 'Rainbow Rd.', 'Sunnyville', 'CA', '1234');

insert into supplier values('Feed All The Pets', 5551234);

insert into supplier values('Play With All the Toys', 1234567);

insert into supplier values('Creatures R Us', 3245612);

insert into supplier values('Nom Nom Noms', 8593957);

insert into supplier values('Yay Toys', 9323512);

insert into suppaddr values('Feed All The Pets', 'Ashley Pkwy', 'Ashland', 'MO', '6543');

insert into suppaddr values('Play With All the Toys', 'Blitzen Ave', 'North Pole', 'Alaska', '1225');

insert into suppaddr values('Creatures R Us', 'Easy St', 'Little Rock', 'AR', '9865');

insert into suppaddr values('Nom Nom Noms', 'Speedy Dr', 'Salt Lake City', 'UT', '1234');

insert into suppaddr values('Yay Toys', 'Vroom Vroom Rd', 'Little Town', 'KY', '1234');

insert into toy values('TOY0000001', 90, 'Tennis Ball', 3.00);

insert into toy values('TOY0000002', 50, 'Hamster Wheel', 10.74);

insert into toy values('TOY0000003', 11, 'Aquarium Plant', 6.82);

insert into toy values('TOY0000004', 45, 'Bell', 4.54);

insert into toy values('TOY0000005', 32, 'Rope', 17.00);

insert into toy values('TOY0000006', 85, 'Rock', 5.00);

insert into toy values('TOY0000007', 21, 'Perch', 2.00);

insert into toy values('TOY0000008', 10, 'Kitty Castle', 54.00);

insert into toy values('TOY0000009', 30, 'Small Pool', 13.87);

insert into toy values('TOY0000010', 90, 'Tube Maze', 29.99);

insert into pet values('DOG0000001', 100.00, 10);

insert into pet values('CAT0000002', 50.99, 14);

insert into pet values('FISH000001', 3.56, 1);

insert into pet values('FISH000002', 50.99, 2);

insert into pet values('SNAKE00001', 14.66, 5);

insert into pet values('LIZARD0002', 50.99, 14);

insert into pet values('BIRD000001', 25.93, 7);

insert into pet values('BIRD000002', 78.43, 20);

insert into bird values('BIRD000001', 0);

insert into bird values('BIRD000002', 1);

insert into mammal values('DOG000001', 'long', 0);

insert into mammal values('CAT000002', 'short', 0);

insert into fish values('FISH000001', 'Fresh');

insert into fish values('FISH000002', 'Salt');

insert into reptile values('SNAKE00001', 0);

insert into reptile values('LIZARD0002', 4);

insert into caretaker values('CAT0000002', 'Ashley', 20, 1234567, 7654321);

insert into caretaker values('BIRD000001', 'Deborah', 30, 9283756, 3029573);

insert into caretaker values('SNAKE00001', 'Aaron', 30, 3958276, 2049286);

insert into caretaker values('DOG0000001', 'Billy', 10, 2029492, 2019382);

insert into caretaker values('BIRD000002', 'Bob', 20, 9485768, 2049684);


insert into playswith values('CAT0000002', 'TOY0000008');

insert into playswith values('DOG0000001', 'TOY0000001');

insert into playswith values('BIRD000001', 'TOY0000004');

insert into playswith values('BIRD000002', 'TOY0000005');

insert into playswith values('LIZARD0002', 'TOY0000002');

insert into playswith values('FISH000001', 'TOY0000003');

insert into playswith values('SNAKE00001', 'TOY0000009');

insert into playswith values('FISH000002', 'TOY0000006');

insert into eats values('DOG0000001', 'FOOD000002');

insert into eats values('CAT0000002', 'FOOD000001');

insert into eats values('BIRD000002', 'FOOD000005');

insert into eats values('BIRD000001', 'FOOD000005');

insert into eats values('FISH000001', 'FOOD000003');

insert into eats values('FISH000002', 'FOOD000003');

insert into eats values('SNAKE00001', 'FOOD000004');

insert into eats values('LIZARD0001', 'FOOD000004');

insert into suppfood values('Nom Nom Noms', 'FOOD00001');

insert into suppfood values('Nom Nom Noms', 'FOOD00002');

insert into suppfood values('Nom Nom Noms', 'FOOD00003');

insert into suppfood values('Feed All The Pets', 'FOOD00004');

insert into suppfood values('Feed All The Pets', 'FOOD00005');

insert into supppets values('Creatures R Us', 'DOG0000001');

insert into supppets values('Creatures R Us', 'CAT0000002');

insert into supppets values('Creatures R Us', 'SNAKE00001');

insert into supppets values('Creatures R Us', 'LIDARD0002');

insert into supppets values('Supply All the Pets', 'FISH000001');

insert into supppets values('Supply All the Pets', 'FISH000002');

insert into supppets values('Supply All the Pets', 'BIRD000001');

insert into supppets values('Supply All the Pets', 'BIRD000002');

insert into supptoys values('Play With All the Toys', 'TOY0000001');

insert into supptoys values('Play With All the Toys', 'TOY0000002');

insert into supptoys values('Play With All the Toys', 'TOY0000003');

insert into supptoys values('Play With All the Toys', 'TOY0000004');

insert into supptoys values('Play With All the Toys', 'TOY0000005');

insert into supptoys values('Yay Toys', 'TOY0000006');

insert into supptoys values('Yay Toys', 'TOY0000007');

insert into supptoys values('Yay Toys', 'TOY0000008');

insert into supptoys values('Yay Toys', 'TOY0000009');

insert into supptoys values('Yay Toys', 'TOY00000010');

insert into pet_allergens values('DOG0000001', 'Dandruff');

insert into pet_allergens values('DOG0000001', 'Dander');

insert into pet_allergens values('CAT0000001', 'Dandruff');
