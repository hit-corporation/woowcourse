--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.3
-- Dumped by pg_dump version 14.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

--
-- Name: actionlogs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.actionlogs (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    "user" character varying(100) NOT NULL,
    ipadd character varying(50) NOT NULL,
    logtime timestamp(0) without time zone NOT NULL,
    logdetail text NOT NULL,
    info text NOT NULL
);


ALTER TABLE public.actionlogs OWNER TO postgres;

--
-- Name: actionlogs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.actionlogs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.actionlogs_id_seq OWNER TO postgres;

--
-- Name: actionlogs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.actionlogs_id_seq OWNED BY public.actionlogs.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    category_name character varying(150) NOT NULL,
    parent_category integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categories_id_seq OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: courses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.courses (
    id bigint NOT NULL,
    course_code character varying(245) NOT NULL,
    course_title character varying(245) NOT NULL,
    course_img text,
    description text,
    instructor_id bigint NOT NULL,
    category_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    rating real,
    price integer
);


ALTER TABLE public.courses OWNER TO postgres;

--
-- Name: courses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.courses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.courses_id_seq OWNER TO postgres;

--
-- Name: courses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.courses_id_seq OWNED BY public.courses.id;


--
-- Name: instructors; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.instructors (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    first_name character varying(200),
    last_name character varying(200),
    email character varying(120),
    phone character varying(20),
    photo text,
    about text,
    address character varying(255)
);


ALTER TABLE public.instructors OWNER TO postgres;

--
-- Name: instructors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.instructors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.instructors_id_seq OWNER TO postgres;

--
-- Name: instructors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.instructors_id_seq OWNED BY public.instructors.id;


--
-- Name: members; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.members (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    first_name character varying(200),
    last_name character varying(200),
    email character varying(200),
    photo text,
    phone character varying(20),
    last_login_date timestamp(0) without time zone NOT NULL,
    as_instructor boolean DEFAULT false NOT NULL
);


ALTER TABLE public.members OWNER TO postgres;

--
-- Name: members_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.members_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.members_id_seq OWNER TO postgres;

--
-- Name: members_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.members_id_seq OWNED BY public.members.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    user_no character varying(50) NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    expired_at timestamp(0) without time zone,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: ratings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ratings (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    topic_id integer NOT NULL,
    member_id integer NOT NULL,
    rate double precision NOT NULL
);


ALTER TABLE public.ratings OWNER TO postgres;

--
-- Name: ratings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ratings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ratings_id_seq OWNER TO postgres;

--
-- Name: ratings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ratings_id_seq OWNED BY public.ratings.id;


--
-- Name: subscriptions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.subscriptions (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    topic_id integer NOT NULL,
    member_id integer NOT NULL,
    instructor_id integer NOT NULL,
    start_date timestamp(0) without time zone NOT NULL,
    end_date timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.subscriptions OWNER TO postgres;

--
-- Name: subscriptions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.subscriptions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.subscriptions_id_seq OWNER TO postgres;

--
-- Name: subscriptions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.subscriptions_id_seq OWNED BY public.subscriptions.id;


--
-- Name: topics; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.topics (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    category_id integer NOT NULL,
    title character varying(200),
    instructor_id integer NOT NULL,
    content_file text,
    description text,
    price double precision,
    rating real
);


ALTER TABLE public.topics OWNER TO postgres;

--
-- Name: topics_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.topics_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.topics_id_seq OWNER TO postgres;

--
-- Name: topics_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.topics_id_seq OWNED BY public.topics.id;


--
-- Name: user_level; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_level (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_level_id integer NOT NULL,
    user_level_name character varying(255) NOT NULL
);


ALTER TABLE public.user_level OWNER TO postgres;

--
-- Name: user_level_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_level_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_level_id_seq OWNER TO postgres;

--
-- Name: user_level_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_level_id_seq OWNED BY public.user_level.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_code character varying(200) NOT NULL,
    first_name character varying(150),
    last_name character varying(150),
    email character varying(200) NOT NULL,
    password character varying(255) NOT NULL,
    user_level integer NOT NULL,
    last_login timestamp(0) without time zone NOT NULL,
    active integer NOT NULL,
    photo text
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: actionlogs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actionlogs ALTER COLUMN id SET DEFAULT nextval('public.actionlogs_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: courses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses ALTER COLUMN id SET DEFAULT nextval('public.courses_id_seq'::regclass);


--
-- Name: instructors id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instructors ALTER COLUMN id SET DEFAULT nextval('public.instructors_id_seq'::regclass);


--
-- Name: members id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members ALTER COLUMN id SET DEFAULT nextval('public.members_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: ratings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings ALTER COLUMN id SET DEFAULT nextval('public.ratings_id_seq'::regclass);


--
-- Name: subscriptions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subscriptions ALTER COLUMN id SET DEFAULT nextval('public.subscriptions_id_seq'::regclass);


--
-- Name: topics id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.topics ALTER COLUMN id SET DEFAULT nextval('public.topics_id_seq'::regclass);


--
-- Name: user_level id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_level ALTER COLUMN id SET DEFAULT nextval('public.user_level_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: actionlogs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.actionlogs (id, created_at, updated_at, "user", ipadd, logtime, logdetail, info) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, created_at, updated_at, category_name, parent_category) FROM stdin;
1	2023-11-10 10:22:00	\N	All	0
2	2023-11-10 10:22:00	\N	Pengembangan	1
3	2023-11-10 10:22:00	\N	Pengembangan Web	2
4	2023-11-10 10:22:00	\N	Ilmu Data	2
5	2023-11-10 10:22:00	\N	Pengembangan Seluler	2
6	2023-11-10 10:22:00	\N	Bahasa Pemrograman	2
7	2023-11-10 10:22:00	\N	Pengembangan Game	2
8	2023-11-10 10:22:00	\N	Desain dan Pengembangan Database	2
9	2023-11-10 10:22:00	\N	Pengujian Perangkat Lunak	2
10	2023-11-10 10:22:00	\N	Rekayasa Perangkat Lunak	2
11	2023-11-10 10:22:00	\N	Alat Pengembangan Perangkat Lunak	2
12	2023-11-10 10:22:00	\N	Pengembangan Tanpa Kode	2
13	2023-11-10 10:22:00	\N	Bisnis	1
14	2023-11-10 10:22:00	\N	Kewirausahaan	13
15	2023-11-10 10:22:00	\N	Komunikasi	13
16	2023-11-10 10:22:00	\N	Manajemen	13
17	2023-11-10 10:22:00	\N	Penjualan	13
18	2023-11-10 10:22:00	\N	Strategi Bisnis	13
19	2023-11-10 10:22:00	\N	Operasi	13
20	2023-11-10 10:22:00	\N	Manajemen Proyek	13
21	2023-11-10 10:22:00	\N	Hukum Bisnis	13
22	2023-11-10 10:22:00	\N	Analisis dan Kecerdasan Bisnis	13
23	2023-11-10 10:22:00	\N	Sumber Daya Manusia	13
24	2023-11-10 10:22:00	\N	Industri	13
25	2023-11-10 10:22:00	\N	Ecomerce	13
26	2023-11-10 10:22:00	\N	Media	13
27	2023-11-10 10:22:00	\N	Real Estate	13
28	2023-11-10 10:22:00	\N	Bisnis Lainnya	13
29	2023-11-10 10:22:00	\N	Keuangan dan Akuntansi	1
30	2023-11-10 10:22:00	\N	Akuntansi dan Laporan Keuangan	29
31	2023-11-10 10:22:00	\N	Kepatuhan	29
32	2023-11-10 10:22:00	\N	Cryptocurrency dan Blockchain	29
33	2023-11-10 10:22:00	\N	Ekonomi	29
34	2023-11-10 10:22:00	\N	Keuangan	29
35	2023-11-10 10:22:00	\N	Sertifikasi dan Persiapan Ujian Keuangan	29
36	2023-11-10 10:22:00	\N	Pemodelan dan Analisis Keuangan	29
37	2023-11-10 10:22:00	\N	Investasi dan Perdagangan	29
38	2023-11-10 10:22:00	\N	Alat Manajemen Keuangan	29
39	2023-11-10 10:22:00	\N	Pajak	29
40	2023-11-10 10:22:00	\N	Keuangan dan Akuntanti Lainnya	29
41	2023-11-10 10:22:00	\N	TI dan Perangkat Lunak	1
42	2023-11-10 10:22:00	\N	Serifikasi TI	41
43	2023-11-10 10:22:00	\N	Jaringan dan Keamanan	41
44	2023-11-10 10:22:00	\N	Perangkat Keras	41
45	2023-11-10 10:22:00	\N	Sistem Operasi & Server	41
46	2023-11-10 10:22:00	\N	TI Perangkat Lunak & Lainnya	41
47	2023-11-10 10:22:00	\N	Desain	1
48	2023-11-10 10:22:00	\N	Desain Web	47
49	2023-11-10 10:22:00	\N	Alat Desain	47
50	2023-11-10 10:22:00	\N	Desain Grafis & Ilustrasi	47
51	2023-11-10 10:22:00	\N	Desain Pengalaman Pengguna	47
52	2023-11-10 10:22:00	\N	Desain Game	47
53	2023-11-10 10:22:00	\N	3D & Animasi	47
54	2023-11-10 10:22:00	\N	Desain Fashion	47
55	2023-11-10 10:22:00	\N	Desain Arsitektur	47
56	2023-11-10 10:22:00	\N	Desain Interior	47
57	2023-11-10 10:22:00	\N	Desain Lainnya	47
\.


--
-- Data for Name: courses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.courses (id, course_code, course_title, course_img, description, instructor_id, category_id, created_at, updated_at, rating, price) FROM stdin;
3	C0002	Pemrograman PHP Menengah	\N	Pemrograman PHP Menengah	1	3	2023-11-13 08:56:00	\N	3.20000005	150000
4	C0003	Pemrograman PHP Expert	\N	Pemrograman PHP Expert	1	3	2023-11-13 08:56:00	\N	4.80000019	125000
2	C0001	Pemrograman PHP Pemula Dari Nol	\N	Selamat datang di Tutorial Belajar PHP untuk pemula..\r\n\r\nBanyak pemula yang bingung dan bertanya:\r\n\r\n“Gimana sih cara membuat web dengan PHP?”\r\n\r\n“Apa saja alat-alat yang diperlukan untuk coding PHP?”\r\n\r\n“Mengapa kita butuh PHP?”\r\n\r\n..dan masih banyak pertanyaan lainnya.\r\n\r\nTentang..\r\n\r\nKita akan mempelajarinya sampai paham.\r\n\r\nMulai dari sejarah awal kemunculan PHP, sampai bisa paham konsep dasar pemrograman PHP.	1	3	2023-11-13 08:56:00	\N	4.5	99000
\.


--
-- Data for Name: instructors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instructors (id, created_at, updated_at, first_name, last_name, email, phone, photo, about, address) FROM stdin;
1	2023-11-13 08:55:00	\N	Abduh	Lestaluhu	abduh.lestaluhu@gmail.com	085621249433	3.jpg	Lecturer of Informatics Engineering Dept. at Pasundan University, Bandung - Indonesia.\r\n\r\nCurrently teaching Web Design and Web Programming.\r\n\r\nAlso doing research in Web Technology, Multimedia, Cognitive Science and UI/UX Design.	Jl. Bangka Raya, Kebayoran Baru, Jakarta Selatan, DKI Jakarta
11	\N	\N	tes 1	tes 1	fauzi.enginer@gmail.com	tes 1	46c9e11c14146b1aec1be924063b0405.jpg	<p>tes 1</p>	tes 1
\.


--
-- Data for Name: members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.members (id, created_at, updated_at, first_name, last_name, email, photo, phone, last_login_date, as_instructor) FROM stdin;
2	\N	\N	Tony	Sucipto	tony.sucipto@gmail.com	\N	\N	2023-11-14 10:56:00	f
4	\N	\N	Marko	Simic	marko.simic@gmail.com	\N	\N	2023-11-14 10:56:00	f
3	\N	\N	Riko	Simanjuntak	riko.simanjuntak@gmail.com	\N	\N	2023-11-14 10:56:00	f
5	\N	\N	Maman	Abdurahman	maman.abdurahman@gmail.com	\N	\N	2023-11-14 10:56:00	f
6	\N	\N	Andritany	Ardhiyasa	andritany.ardhiyasa@gmail.com	\N	\N	2023-11-14 10:56:00	f
7	\N	\N	Hansamu	Yama	hansamu.yama@gmail.com	\N	\N	2023-11-14 10:56:00	f
22	\N	\N	tes 1	tes 1	fauzi.enginer@gmail.com	6162b791c3da45b99b7353240210e6fe.jpeg	tes 1	2023-11-22 15:51:16	t
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2019_12_14_000001_create_personal_access_tokens_table	1
2	2023_10_31_093328_create_users_table	1
3	2023_10_31_094210_create_actionlogs_table	1
4	2023_10_31_095223_create_categories_table	1
5	2023_10_31_095346_create_instructors_table	1
6	2023_10_31_095458_create_members_table	1
7	2023_10_31_095750_create_ratings_table	1
8	2023_10_31_100026_create_subscriptions_table	1
9	2023_10_31_100222_create_topics_table	1
10	2023_10_31_100422_create_user_level_table	1
11	2023_11_01_071805_create_courses_table	1
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_access_tokens (id, user_no, name, token, abilities, expired_at, last_used_at, created_at, updated_at) FROM stdin;
1	cb9f5c7d-3878-4769-be7a-b1da74d80986	reg_1700029422	qw2ZEeNWeAvxt7BFoP6U181s	\N	2023-11-15 14:23:42	\N	2023-11-15 13:23:42	2023-11-15 13:23:42
\.


--
-- Data for Name: ratings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ratings (id, created_at, updated_at, topic_id, member_id, rate) FROM stdin;
1	\N	\N	1	1	4
2	\N	\N	1	2	5
3	\N	\N	1	3	4
4	\N	\N	2	1	3
5	\N	\N	2	2	5
\.


--
-- Data for Name: subscriptions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subscriptions (id, created_at, updated_at, topic_id, member_id, instructor_id, start_date, end_date) FROM stdin;
3	2023-11-01 00:00:00	\N	2	1	1	2023-11-01 00:00:00	2023-11-30 00:00:00
4	2023-11-01 00:00:00	\N	3	2	1	2023-11-01 00:00:00	2023-11-30 00:00:00
1	2023-11-01 00:00:00	\N	4	1	1	2023-11-01 00:00:00	2023-11-30 00:00:00
2	2023-11-01 00:00:00	\N	4	2	1	2023-11-01 00:00:00	2023-11-30 00:00:00
\.


--
-- Data for Name: topics; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.topics (id, created_at, updated_at, category_id, title, instructor_id, content_file, description, price, rating) FROM stdin;
\.


--
-- Data for Name: user_level; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_level (id, created_at, updated_at, user_level_id, user_level_name) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, created_at, updated_at, user_code, first_name, last_name, email, password, user_level, last_login, active, photo) FROM stdin;
1	2023-11-15 13:23:42	2023-11-15 13:23:42	cb9f5c7d-3878-4769-be7a-b1da74d80986	Web	Developer	fauzi.enginer@gmail.com	$2y$10$pieq7t0.374r44BwVz4j0uvVfEO5OIjOIBdY/OctznCwZHsSvZhQy	2	2023-11-16 02:51:42	1	\N
3	2023-11-15 13:23:42	2023-11-15 13:23:42	cb9f5c7d-3878-4769-be7a-b1da74d80987	\N	\N	abduh.lestaluhu@gmail.com	$2y$10$pieq7t0.374r44BwVz4j0uvVfEO5OIjOIBdY/OctznCwZHsSvZhQy	2	2023-11-15 13:23:42	1	\N
\.


--
-- Name: actionlogs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.actionlogs_id_seq', 1, false);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 1, false);


--
-- Name: courses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.courses_id_seq', 4, true);


--
-- Name: instructors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instructors_id_seq', 11, true);


--
-- Name: members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.members_id_seq', 22, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 11, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, true);


--
-- Name: ratings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ratings_id_seq', 5, true);


--
-- Name: subscriptions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.subscriptions_id_seq', 4, true);


--
-- Name: topics_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.topics_id_seq', 1, false);


--
-- Name: user_level_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_level_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 3, true);


--
-- Name: actionlogs actionlogs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actionlogs
    ADD CONSTRAINT actionlogs_pkey PRIMARY KEY (id);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: courses courses_course_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT courses_course_code_unique UNIQUE (course_code);


--
-- Name: courses courses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT courses_pkey PRIMARY KEY (id);


--
-- Name: instructors instructors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instructors
    ADD CONSTRAINT instructors_pkey PRIMARY KEY (id);


--
-- Name: members members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members
    ADD CONSTRAINT members_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: ratings ratings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT ratings_pkey PRIMARY KEY (id);


--
-- Name: subscriptions subscriptions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subscriptions
    ADD CONSTRAINT subscriptions_pkey PRIMARY KEY (id);


--
-- Name: topics topics_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.topics
    ADD CONSTRAINT topics_pkey PRIMARY KEY (id);


--
-- Name: user_level user_level_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_level
    ADD CONSTRAINT user_level_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_user_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_user_code_unique UNIQUE (user_code);


--
-- Name: courses courses_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT courses_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: courses courses_instructor_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT courses_instructor_id_foreign FOREIGN KEY (instructor_id) REFERENCES public.instructors(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

