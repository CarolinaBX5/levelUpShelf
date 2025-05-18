create user admin with encrypted password 'admin';
create database bdsteam with owner admin encoding 'utf8';
revoke all privileges on database bdsteam from public;
grant all privileges on database bdsteam to admin;
alter database bdsteam set search_path to proyecto;

\connect bdsteam;
drop schema if exists proyecto cascade;
create schema if not exists proyecto authorization admin;

create user app with encrypted password 'app';
grant connect on database bdsteam to app;
grant usage on schema proyecto to app;
alter default privileges in schema proyecto
    grant select, insert, update, delete on tables to app;
alter default privileges in schema proyecto
    grant usage on sequences to app;
