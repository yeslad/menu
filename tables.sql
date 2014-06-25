CREATE TABLE nesting (
    id SERIAL PRIMARY KEY,
    is_link boolean,
    parent_id integer
);
CREATE TYPE target as ENUM ('blank', 'top', 'self', 'parent');

CREATE TABLE link_data (
	id integer PRIMARY KEY,
	text text,
	href text,
	nofollow boolean,
	target target
);
