# Database

```sql
CREATE TABLE `loginlogs` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `ipaddress` VARBINARY(16) NULL DEFAULT NULL,
    `TryTime` BIGINT(20) NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=17
;
```

```sql
CREATE TABLE `users` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`username` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
`password` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;
```
