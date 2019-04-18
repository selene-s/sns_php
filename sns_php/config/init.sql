create database dotinstall_sns_php;

grant all on dotinstall_sns_php.* to dbuser@localhost identified by 'mu4uJsif';

use dotinstall_sns_php

create table users (
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  modified datetime
);

desc users;

/*
create database　データベース作成
grant all on ユーザーの権限設定　→→→　全てのテーブルに対して、ローカルホストからdbuserがtableにアクセスできるよう
use データベースへ切り替え
create table テーブルの作成
auto_incrementとは カラムに値が指定されなかった場合、MySQLが自動的に値を割り当てる。
データ型は整数。値は1ずつ増加して連番になる。  idを主Keyで連番に

mysql> desc users;
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| email    | varchar(255) | YES  | UNI | NULL    |                |
| password | varchar(255) | YES  |     | NULL    |                |
| created  | datetime     | YES  |     | NULL    |                |
| modified | datetime     | YES  |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
5 rows in set (0.00 sec)

  ・email は varchar(255) にしてあげて、あと重複すると困るので unique キーをつける。
  ・password に関しては、varchar(255) で管理
  　※int(11)の11は、カラムの表示幅であり、データベースの運用上はあまり意味がない。
  　※varchar(255)の255は文字数であり、UTF-8（3バイト文字）でも２５５文字の格納が可能。
    ※ユニーク制約 (UNIQUE制約)とは   データベースの項目に付与する「他の行の値と重複しちゃダメよ制約」のこと。
  
  ・レコードが作られた日時（created datetime）
  ・変更された日時（modified datetime）
  
 desc users;　---テーブルの状態を確認

ーーーーーーーーーーー
table確認手順

①mysql -u rootでsqlに入る
②存在しているデータベースへ接続する方法を確認。
  USE文を使う。
　use dotinstall_sns_php
③desc users;
上記でコマンド上でテーブルが見れる

④psqlからの切断方法
\q

*/