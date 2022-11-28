CREATE TABLE companies (
    id bigint NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (id)
);

CREATE TABLE locations (
    id bigint NOT NULL AUTO_INCREMENT,
    company_id bigint NOT NULL,
    name varchar(100) NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE assets (
    id bigint NOT NULL AUTO_INCREMENT,
    company_id bigint NOT NULL,
    name varchar(100) NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE managers (
    id bigint NOT NULL AUTO_INCREMENT,
    company_id bigint NOT NULL,
    name varchar(100) NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE company_groups (
    id bigint NOT NULL AUTO_INCREMENT,
    company_id bigint NOT NULL,
    name varchar(100) NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (company_id) REFERENCES companies(id)
);



CREATE TABLE employeers (
    id bigint NOT NULL AUTO_INCREMENT,
    company_id bigint NOT NULL,
    company_group_id bigint NULL,
    name varchar(100) NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (company_id) REFERENCES companies(id),
    FOREIGN KEY (company_group_id) REFERENCES company_groups(id)
);

CREATE TABLE peoples (
    id bigint NOT NULL AUTO_INCREMENT,
    manager_id bigint NOT NULL,
    employeer_id bigint NOT NULL,
    name varchar(100) NOT NULL,
    description varchar(255) NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (manager_id) REFERENCES managers(id),
    FOREIGN KEY (employeer_id) REFERENCES employeers(id)
);


