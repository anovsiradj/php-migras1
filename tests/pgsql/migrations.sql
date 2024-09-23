
create table if not exists migrations (
	migration varchar(256) not null PRIMARY KEY,
	created_at timestamp null,
	updated_at timestamp null
)
