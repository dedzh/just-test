CREATE TABLE products(
    id int primary key AUTOINCREMENT,
    sku text unique,
    name text not null,
    quantity int default 0, 
    qprice real default 0, 
    created_at text current_timestamp

);