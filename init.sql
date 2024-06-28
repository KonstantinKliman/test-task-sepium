USE test_app;

CREATE TABLE IF NOT EXISTS users
(
    id         bigint(20) NOT NULL,
    name       varchar(255) NOT NULL,
    email      varchar(255) NOT NULL,
    password   varchar(255) NOT NULL,
    created_at timestamp    NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE users
    ADD PRIMARY KEY (id),
  ADD UNIQUE KEY idx_email (email);

ALTER TABLE users
    MODIFY id bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;