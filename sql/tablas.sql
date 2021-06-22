-- ------------------------------
drop table if exists micros;

drop table if exists placas;

-- ------------------------------
create table micros(
    id int AUTO_INCREMENT primary key,
    marca enum(
        'Amd',
        'ARM',
        'Intel',
        'Qualcomm',
        'MediaTek'
    ),
    modelo varchar(80),
    numprocesadores int unsigned default 1
);

create table placas(
    id int AUTO_INCREMENT primary key,
    marca enum(
       'Asus',
       'GigaByte',
       'MSI'
    ),
    modelo varchar(60),
    precio decimal(6,2),
    microId int,
    constraint fk_micro_placa foreign key(microId) references micros(id) on update cascade on delete set null
);

-- ----------------------------------------------------------------------
insert into micros(marca, modelo, numprocesadores) values(3, 'Intel® Core™ i3-11100B Processor (12M Cache, 3.60 GHz)', 4);
insert into micros(marca, modelo, numprocesadores) values(3, 'Procesador Intel® Core™ i3-1115G4 (caché de 6 MB, hasta 4,10 GHz)', 4);
insert into micros(marca, modelo, numprocesadores) values(3, 'Intel® Core™ i9-11900KB Processor (24M Cache, up to 4.90 GHz)', 8);
insert into micros(marca, modelo, numprocesadores) values(3, 'Intel® Core™ i9-11900KB Processor (24M Cache, up to 4.90 GHz)', 8);
insert into micros(marca, modelo, numprocesadores) values(1, 'AMD Ryzen Threadripper 3990X', 8);
insert into micros(marca, modelo, numprocesadores) values(1, 'AMD Ryzen 5 5600X 37GHz', 8);
insert into micros(marca, modelo, numprocesadores) values(2, 'Cortex-A5 ', 2);
insert into micros(marca, modelo, numprocesadores) values(2, 'Cortex-A8 ', 2);
insert into micros(marca, modelo, numprocesadores) values(4, 'Snapdragon 865', 8);
insert into micros(marca, modelo, numprocesadores) values(4, 'Snapdragon 865 Plus 5G', 8);
insert into micros(marca, modelo, numprocesadores) values(5, 'MediaTek MT6753', 8);
insert into micros(marca, modelo, numprocesadores) values(5, 'MediaTek Helio P', 8);
-- -----------------------------------------------------------------------------------------------
insert into placas(marca, modelo, precio, microId) values(1, 'Prime H370M Plus', 456.78, 1);
insert into placas(marca, modelo, precio, microId) values(1, 'ROG Strix B360-H Gaming', 1456.78, 2);
insert into placas(marca, modelo, precio, microId) values(1, 'TUF GAMING B460 PLUS', 856.78, 3);
insert into placas(marca, modelo, precio, microId) values(2, 'X570 Aorus Elite', 256.78, 4);
insert into placas(marca, modelo, precio, microId) values(2, 'B450 Aorus Elite V2', 126.78, 5);
insert into placas(marca, modelo, precio, microId) values(2, 'B550 AORUS PRO V2', 56.78, 6);
insert into placas(marca, modelo, precio, microId) values(3, 'X470 Gaming Plus Max', 496.78, 7);
insert into placas(marca, modelo, precio, microId) values(3, 'MPG Z490 GAMING PLUS', 459.18, 8);
insert into placas(marca, modelo, precio, microId) values(3, 'MAG X570 TOMAHAWK WIFI', 356.78, 9);

