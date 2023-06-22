/*
PostgreSQL Backup
Database: marketplace/public
Backup Time: 2023-06-22 09:29:53
*/

DROP SEQUENCE IF EXISTS "public"."migrations_id_seq";
DROP SEQUENCE IF EXISTS "public"."products_id_seq";
DROP SEQUENCE IF EXISTS "public"."taxes_id_seq";
DROP SEQUENCE IF EXISTS "public"."types_id_seq";
DROP TABLE IF EXISTS "public"."migrations";
DROP TABLE IF EXISTS "public"."products";
DROP TABLE IF EXISTS "public"."sales";
DROP TABLE IF EXISTS "public"."taxes";
DROP TABLE IF EXISTS "public"."types";
CREATE SEQUENCE "migrations_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;
CREATE SEQUENCE "products_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;
CREATE SEQUENCE "taxes_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;
CREATE SEQUENCE "types_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;
CREATE TABLE "migrations" (
  "id" int4 NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
  "migration" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "batch" int4 NOT NULL
)
;
ALTER TABLE "migrations" OWNER TO "postgres";
CREATE TABLE "products" (
  "id" int8 NOT NULL DEFAULT nextval('products_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "type_id" int4 NOT NULL,
  "price" float8 NOT NULL,
  "description" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_date" timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP
)
;
ALTER TABLE "products" OWNER TO "postgres";
CREATE TABLE "sales" (
  "id" uuid NOT NULL,
  "amount" int4 NOT NULL,
  "product_id" int4 NOT NULL,
  "created_date" timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP
)
;
ALTER TABLE "sales" OWNER TO "postgres";
CREATE TABLE "taxes" (
  "id" int8 NOT NULL DEFAULT nextval('taxes_id_seq'::regclass),
  "percentage" float8 NOT NULL,
  "created_date" timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP
)
;
ALTER TABLE "taxes" OWNER TO "postgres";
CREATE TABLE "types" (
  "id" int8 NOT NULL DEFAULT nextval('types_id_seq'::regclass),
  "tax_id" int4 NOT NULL,
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_date" timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP
)
;
ALTER TABLE "types" OWNER TO "postgres";
BEGIN;
LOCK TABLE "public"."migrations" IN SHARE MODE;
DELETE FROM "public"."migrations";
INSERT INTO "public"."migrations" ("id","migration","batch") VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1),(2, '2023_06_20_013800_create_taxes_table', 1),(3, '2023_06_20_013814_create_types_table', 1),(4, '2023_06_20_013915_create_products_table', 1),(5, '2023_06_20_192813_create_sales_table', 1);
COMMIT;
BEGIN;
LOCK TABLE "public"."products" IN SHARE MODE;
DELETE FROM "public"."products";
INSERT INTO "public"."products" ("id","name","type_id","price","description","created_date") VALUES (1, 'Gibson Les Paul', 1, 8000, 'Guitarra Gibson Les Paul Standard', '2023-06-20 22:32:20'),(4, 'Hello World', 1, 3000, 'Hello World', '2023-06-21 16:20:07'),(5, 'Hello World 2', 1, 3000, 'Hello World 2', '2023-06-21 16:21:48'),(3, 'Item Número 3', 1, 3000, 'Teste', '2023-06-20 23:46:03');
COMMIT;
BEGIN;
LOCK TABLE "public"."sales" IN SHARE MODE;
DELETE FROM "public"."sales";
COMMIT;
BEGIN;
LOCK TABLE "public"."taxes" IN SHARE MODE;
DELETE FROM "public"."taxes";
INSERT INTO "public"."taxes" ("id","percentage","created_date") VALUES (1, 15, '2023-06-20 22:31:23');
COMMIT;
BEGIN;
LOCK TABLE "public"."types" IN SHARE MODE;
DELETE FROM "public"."types";
INSERT INTO "public"."types" ("id","tax_id","name","created_date") VALUES (1, 1, 'Guitarras', '2023-06-20 22:31:37');
COMMIT;
ALTER TABLE "migrations" ADD CONSTRAINT "migrations_pkey" PRIMARY KEY ("id");
ALTER TABLE "products" ADD CONSTRAINT "products_pkey" PRIMARY KEY ("id");
CREATE INDEX "products_type_id_index" ON "products" USING btree (
  "type_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
CREATE INDEX "sales_id_index" ON "sales" USING btree (
  "id" "pg_catalog"."uuid_ops" ASC NULLS LAST
);
CREATE INDEX "sales_product_id_index" ON "sales" USING btree (
  "product_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
ALTER TABLE "taxes" ADD CONSTRAINT "taxes_pkey" PRIMARY KEY ("id");
ALTER TABLE "types" ADD CONSTRAINT "types_pkey" PRIMARY KEY ("id");
CREATE INDEX "types_tax_id_index" ON "types" USING btree (
  "tax_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
ALTER TABLE "products" ADD CONSTRAINT "products_type_id_foreign" FOREIGN KEY ("type_id") REFERENCES "public"."types" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "sales" ADD CONSTRAINT "sales_product_id_foreign" FOREIGN KEY ("product_id") REFERENCES "public"."products" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "types" ADD CONSTRAINT "types_tax_id_foreign" FOREIGN KEY ("tax_id") REFERENCES "public"."taxes" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER SEQUENCE "migrations_id_seq"
OWNED BY "migrations"."id";
SELECT setval('"migrations_id_seq"', 6, true);
ALTER SEQUENCE "migrations_id_seq" OWNER TO "postgres";
ALTER SEQUENCE "products_id_seq"
OWNED BY "products"."id";
SELECT setval('"products_id_seq"', 6, true);
ALTER SEQUENCE "products_id_seq" OWNER TO "postgres";
ALTER SEQUENCE "taxes_id_seq"
OWNED BY "taxes"."id";
SELECT setval('"taxes_id_seq"', 2, true);
ALTER SEQUENCE "taxes_id_seq" OWNER TO "postgres";
ALTER SEQUENCE "types_id_seq"
OWNED BY "types"."id";
SELECT setval('"types_id_seq"', 2, true);
ALTER SEQUENCE "types_id_seq" OWNER TO "postgres";
