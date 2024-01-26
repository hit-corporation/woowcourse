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
-- Name: carts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.carts (
    id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone,
    course_id integer,
    member_id integer,
    status character varying
);


ALTER TABLE public.carts OWNER TO postgres;

--
-- Name: COLUMN carts.status; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.carts.status IS 'paid, unpaid';


--
-- Name: carts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.carts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.carts_id_seq OWNER TO postgres;

--
-- Name: carts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.carts_id_seq OWNED BY public.carts.id;


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
-- Name: course_videos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.course_videos (
    id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone,
    course_id integer,
    video character varying(255),
    seq smallint
);


ALTER TABLE public.course_videos OWNER TO postgres;

--
-- Name: course_videos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.course_videos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.course_videos_id_seq OWNER TO postgres;

--
-- Name: course_videos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.course_videos_id_seq OWNED BY public.course_videos.id;


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
    price integer,
    course_video character varying(255),
    duration real
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
-- Name: curriculumns; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.curriculumns (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.curriculumns OWNER TO postgres;

--
-- Name: curriculumns_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.curriculumns_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.curriculumns_id_seq OWNER TO postgres;

--
-- Name: curriculumns_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.curriculumns_id_seq OWNED BY public.curriculumns.id;


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
    as_instructor boolean,
    job character varying(200)
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
    course_id integer NOT NULL,
    member_id integer NOT NULL,
    rate double precision NOT NULL,
    comments text
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
-- Name: wishlists; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wishlists (
    id integer NOT NULL,
    created_dt timestamp without time zone DEFAULT now(),
    updated_dt timestamp without time zone,
    member_id integer,
    course_id integer
);


ALTER TABLE public.wishlists OWNER TO postgres;

--
-- Name: wishlists_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.wishlists_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wishlists_id_seq OWNER TO postgres;

--
-- Name: wishlists_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.wishlists_id_seq OWNED BY public.wishlists.id;


--
-- Name: actionlogs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actionlogs ALTER COLUMN id SET DEFAULT nextval('public.actionlogs_id_seq'::regclass);


--
-- Name: carts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carts ALTER COLUMN id SET DEFAULT nextval('public.carts_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: course_videos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.course_videos ALTER COLUMN id SET DEFAULT nextval('public.course_videos_id_seq'::regclass);


--
-- Name: courses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses ALTER COLUMN id SET DEFAULT nextval('public.courses_id_seq'::regclass);


--
-- Name: curriculumns id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curriculumns ALTER COLUMN id SET DEFAULT nextval('public.curriculumns_id_seq'::regclass);


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
-- Name: wishlists id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wishlists ALTER COLUMN id SET DEFAULT nextval('public.wishlists_id_seq'::regclass);


--
-- Data for Name: actionlogs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.actionlogs (id, created_at, updated_at, "user", ipadd, logtime, logdetail, info) FROM stdin;
\.


--
-- Data for Name: carts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.carts (id, created_at, updated_at, course_id, member_id, status) FROM stdin;
1	2023-12-26 13:21:13.206	\N	3	\N	unpaid
2	2023-12-26 16:33:01.099	\N	3	\N	unpaid
3	2023-12-26 16:34:41.673	\N	1	6	unpaid
7	2023-12-28 13:55:54.328	\N	1	\N	unpaid
8	2023-12-28 13:57:54.65	\N	1	\N	unpaid
14	2023-12-28 16:48:13.809	\N	1	8	unpaid
15	2023-12-28 16:48:25.668	\N	2	8	unpaid
16	2023-12-29 09:02:12.992	\N	2	\N	unpaid
18	2024-01-04 16:19:35.012	\N	3	\N	unpaid
19	2024-01-04 16:19:36.075	\N	3	\N	unpaid
20	2024-01-12 16:56:48.932	\N	1	\N	unpaid
21	2024-01-12 16:56:51.088	\N	1	\N	unpaid
22	2024-01-12 16:56:53.916	\N	1	\N	unpaid
29	2024-01-12 16:59:53.879	\N	1	1	unpaid
33	2024-01-22 10:09:04.837	\N	3	1	unpaid
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, created_at, updated_at, category_name, parent_category) FROM stdin;
1	\N	\N	ALL	0
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
2	2023-11-10 10:22:00	\N	Pemrograman	1
\.


--
-- Data for Name: course_videos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.course_videos (id, created_at, updated_at, course_id, video, seq) FROM stdin;
1	2023-12-19 11:59:55.872	\N	1	MS4gRGFzYXIgUGVtcm9ncmFtYW4gZGVuZ2FuIEphdmFzY3JpcHQgSU5UUk8ubXA0MC4xMDU2NzYwMCAxNzAyOTYxOTk2.mp4	1
2	2023-12-19 11:59:55.887	\N	1	NS4gS0VOQVBBIEJFTEFKQVIgSkFWQVNDUklQVCAubXA0MC4xMDYyMzIwMCAxNzAyOTYxOTk2.mp4	2
4	2023-12-19 14:17:49.3	\N	3	TWF0ZXJpIEJLIC0gTWVuZ2VuYWwgVGlwZSBLZXByaWJhZGlhbiBESVNDLm1wNDAuNTUzNDEzMDAgMTcwMjk3MDI2OQ==.mp4	1
5	2023-12-29 10:03:29.4	\N	6	c2FtcGxlLW1wNC1maWxlLXNtYWxsLm1wNDAuNDIyNTc4MDAgMTcwMzgxOTAxMA==.mp4	1
3	2023-12-19 13:40:05.016	\N	2	MTVNQi1NUDQubXA0MC42NjA1ODkwMCAxNzA0MTg1Mzc0.mp4	1
6	2024-01-02 16:38:48.392	\N	7	VklELTIwMjQwMTAzLVdBMDAxNS5tcDQwLjc0Mzg2ODAwIDE3MDQyNjU1NTM=.mp4	1
7	2024-01-04 16:59:27.776	\N	8	ZmlsZV9leGFtcGxlX01QNF80ODBfMV81TUcubXA0MC43NDgwODQwMCAxNzA0MzYyMzcw.mp4	1
8	2024-01-09 14:57:38.723	\N	9	VklELTIwMjQwMTA5LVdBMDAxNi5tcDQwLjk1NDkwMjAwIDE3MDQ3ODcwNTg=.mp4	1
9	2024-01-09 14:57:38.723	\N	9	VklELTIwMjQwMTA5LVdBMDAxNC5tcDQwLjk1NTQ2NjAwIDE3MDQ3ODcwNTg=.mp4	2
10	2024-01-09 14:57:38.739	\N	9	VklELTIwMjQwMTA5LVdBMDAxMy5tcDQwLjk1Njc1MTAwIDE3MDQ3ODcwNTg=.mp4	3
\.


--
-- Data for Name: courses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.courses (id, course_code, course_title, course_img, description, instructor_id, category_id, created_at, updated_at, rating, price, course_video, duration) FROM stdin;
3	4IT87	Sukses Closing Menjual dengan tipe kepribadian DiSC	55def0103e9b57fcbebf4d79807a23cd.jpg	<p>Sukses menjual adalah hak semua orang, termasuk hal Anda juga.</p><p><br></p><p>Namun fakta di lapangan, menjual produk atau jasa mempunyai tantangan tersendiri karena Anda menjual produk dan jasa Anda kepada manusia, yang mempunyai keinginan, harapan dan gaya kepribadian yang berbeda. Dan faktanya lagi, prospek yang menolak membeli produk Anda, lebih banyak karena dipengaruhi cara Anda melakukan pendekatan kepada calon pelanggan Anda.</p><p><br></p><p>Bagi Anda yang mau atau sedang berkecimpung didunia penjualan, mengenali strategi penjualan berdasarkan tipe kepribadian DiSC dan faktor kritikal calon customer Anda dalam membeli produk atau jasa Anda menjadi sangat penting apabila Anda ingin segera melakukan closing Penjualan Anda.</p><p><br></p><p>Materi ini disusun untuk meningkatkan kemampuan menjual Anda secara praktis dan mudah dipahami sehingga membantu Anda dalam melakukan canvassing dan atau presentasi Penjualan produk atau jasa Anda kepada calon customer. Selain itu, Anda juga akan memperoleh strategi komunikasi persuasif yang sesuai berdasarkan tipe kepribadian DiSC untuk mempengaruhi calon customer Anda membeli produk atau jasa yang Anda tawarkan.</p><p><br></p><p>Setelah mengikuti kursus ini, Anda akan mampu :</p><ul><li>Mengenali gaya komunikasi Anda berdasarkan tipe kepribadian DiSC</li><li>Mengenali gaya komunikasi dan proses berpikir lawan bicara Anda berdasarkan tipe kepribadian DiSC</li><li>Mengidentifikasi strategi yang tepat dalam melakukan pendekatan kepada calon pelanggan Anda dengan tipe kepribadian DISC</li><li>Memahami langkah - langkah yang efektif untuk sukses melakukan closing penjualan</li></ul>	3	14	\N	\N	\N	\N	\N	\N
6	4NQB8	teknik bernyanyi suara merdu	8f6f5668f7ca22519a7345de3aa866aa.jpg	<p>teknik bernyanyi suara merdu</p><p>by vokalis ternama</p><p>Andhika Mahesa</p>	7	26	\N	\N	\N	25000	\N	\N
2	8S9YB	Belajar Pemrograman Javascript Tingkat Menengah	e43d50de1bc966a531c42ea91a892ac2.jpg	<p>Belajar Pemrograman Javascript Tingkat Menengah from web programming unpas</p>	1	3	\N	2024-01-02 15:49:34	4.19999981	99000	\N	\N
1	53BFJ	Dasar Pemrograman dengan Javascript	79faa732bf1549c7be07e477be4b61b7.png	<p>Dasar pemrograman dengan javascript intro dan kenapa belajar bahasa javascript</p>	1	3	\N	2023-12-26 10:15:35	4.80000019	55000	\N	\N
\.


--
-- Data for Name: curriculumns; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.curriculumns (id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: instructors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instructors (id, created_at, updated_at, first_name, last_name, email, phone, photo, about, address) FROM stdin;
3	\N	\N	Christine	Manopo, PhD, CBA, CHRP, CFP	christine.manopo@gmail.com	081284847374	8f7bb608bd1ec48365b097bf760bafaa.jpg	<p><span style="color: rgba(0, 0, 0, 0.9);">Christine has more than 20 years experience in business transformation, human capital and business re-engineering, and trainings. She published many books in human capital, self development and business area. She is also a certified international facilitators. She creates many business simulation and boardgames based competency that can help you to strengthen your competency and skill easily and fun.</span></p>	Jl Bandung
8	\N	\N	Jaja	Miharja	jaja.miharja@gmail.com	08676949535	\N	<p><span style="color: rgb(31, 35, 40);">Founder youtube.com/webprogrammingunpas Lecturer @informatikaunpas</span></p>	Jl Bandung
7	\N	\N	Ariel	\N	ariel@gmail.com	089523337483	\N	<p><br></p>	
1	\N	\N	Sandhika	Galih	sandhika.galih@gmail.com	085612344321	ada0cb5943801707f6c07b7da4ee9628.png	<p><span style="color: rgb(31, 35, 40);">Founder youtube.com/webprogrammingunpas Lecturer @informatikaunpas</span></p>	Jl Bandung
\.


--
-- Data for Name: members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.members (id, created_at, updated_at, first_name, last_name, email, photo, phone, last_login_date, as_instructor, job) FROM stdin;
6	\N	\N	Bagus	Budiutomo	bagus.budiutomo@gmail.com	b6cac63bef34c2abb5062e04e1a6dd43.png	085683937733	2023-12-20 11:08:48	f	Student
2	\N	\N	Christine	Manopo, PhD, CBA, CHRP, CFP	christine.manopo@gmail.com	8f7bb608bd1ec48365b097bf760bafaa.jpg	081284847374	2023-12-19 14:04:24	t	Trainer Personal Development
7	\N	\N	Ariel	\N	ariel@gmail.com	57dc5afb1d2a06edcbd215031584340f.jpg	089523337483	2023-12-28 14:26:51	t	Vokalis Band
8	\N	\N	Jaja	Miharja	jaja.miharja@gmail.com	88881d88581481e44b0b2232350b63e5.jpeg	08942748503	2023-12-28 14:31:06	t	Vokalis Bintang
1	\N	\N	Sandhika	Galih	sandhika.galih@gmail.com	3cc9b48c92865c05197a1eca8a5fb5e1.png	085612344321	2023-12-19 11:57:04	t	Dosen Teknik Informatika
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
18	2019_12_14_000001_create_personal_access_tokens_table	1
19	2023_10_31_093328_create_users_table	1
20	2023_10_31_094210_create_actionlogs_table	1
21	2023_10_31_095223_create_categories_table	1
22	2023_10_31_095346_create_instructors_table	1
23	2023_10_31_095458_create_members_table	1
24	2023_10_31_100026_create_subscriptions_table	1
25	2023_10_31_100222_create_topics_table	1
26	2023_10_31_100422_create_user_level_table	1
27	2023_10_31_100500_create_ratings_table	1
28	2023_11_01_071805_create_courses_table	1
29	2023_11_10_023500_create_curriculumns_table	1
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_access_tokens (id, user_no, name, token, abilities, expired_at, last_used_at, created_at, updated_at) FROM stdin;
16	e6b4c2a5-aee2-4934-8254-70e559238739	reg_1706089876	xfgqB9WXTcqEgcC8fufzWKQ6	\N	2024-01-24 17:51:16	\N	2024-01-24 16:51:16	2024-01-24 16:51:16
17	b0155f9d-c871-43c3-a4fb-5fc1b0d82f80	reg_1706146099	mDGM2XpcoajjeoYT1A9rXCow	\N	2024-01-25 09:28:19	2024-01-25 08:39:37	2024-01-25 08:28:19	2024-01-25 08:28:19
\.


--
-- Data for Name: ratings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ratings (id, created_at, updated_at, course_id, member_id, rate, comments) FROM stdin;
7	\N	\N	1	1	4	bodo amat
20	\N	\N	1	6	5	good
21	\N	\N	1	6	5	excelent
23	\N	\N	1	6	1	kurang bagus lah
\.


--
-- Data for Name: subscriptions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subscriptions (id, created_at, updated_at, topic_id, member_id, instructor_id, start_date, end_date) FROM stdin;
1	2023-12-01 00:00:00	\N	1	1	1	2023-12-01 00:00:00	2024-01-01 00:00:00
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
5	2023-12-18 16:08:40	2023-12-18 16:08:40	1fffaf4b-f586-4bf5-9ccd-1b67b74e5c08	\N	\N	nengmoemoen@gmail.com	$2y$10$krLz2UKDkT35coIt.BoeiePYQKpca1kDynmhR91HmLuZ46KwBPhLG	2	2023-12-18 16:08:40	1	\N
7	2023-12-19 11:47:51	2023-12-19 11:47:51	8d2b148a-7310-4eca-8aab-c7ae910910e6	\N	\N	sandhika.galih@gmail.com	$2y$10$DxiC5TEtrDXauQ0HQVc4Y.NLFRgL95/gpJne5.zGSZcV.AWN4S.IG	2	2023-12-19 11:47:51	1	\N
9	2023-12-19 14:00:25	2023-12-19 14:00:25	e5b8de38-7535-4053-b9e7-2d35dfbe1203	\N	\N	christine.manopo@gmail.com	$2y$10$86OCWtw/I.YBUJgh0TbDNOC3uhJ/0VJ0alCZ1hb8cgtYZLtJwSNQG	2	2023-12-19 14:00:25	1	\N
11	2023-12-20 10:52:17	2023-12-20 10:52:17	90b93ff1-f9f0-489c-8eed-31724bafae93	\N	\N	bagus.budiutomo@gmail.com	$2y$10$.BvWDse42rTDEIvpQWouiu6Ato8Siur.Hakdlab52/N74uqlthAnS	2	2023-12-20 10:52:17	1	\N
13	2023-12-28 14:29:17	2023-12-28 14:29:17	3494d1f5-4428-4b1b-8449-51d3ea93ccf1	\N	\N	jaja.miharja@gmail.com	$2y$10$KT5yqZIFeSiGFuLSLngzeu3w2J.mbdKyFeDYx9ne3ZrdhB7qo.Q.e	2	2023-12-28 14:29:17	1	\N
14	2024-01-24 09:09:16	2024-01-24 09:09:16	1e0692f1-d297-4416-9ba0-433455a3b47b	\N	\N	user@gmail.com	$2y$10$SzzG6aL3n41sjXwfyHGqEujE4su4aW9vUCReoEeV4cZDHqflZYizq	2	2024-01-24 09:09:16	1	\N
16	2024-01-24 16:51:16	2024-01-24 16:51:16	e6b4c2a5-aee2-4934-8254-70e559238739	\N	\N	fauzi.enginer@gmail.com	$2y$10$ABnxBN2le3K7CvjPVmcED.PA.GyAH/4LjOynC6IWF6zUnMh7MsTYa	2	2024-01-24 16:51:16	1	\N
17	2024-01-25 08:28:19	2024-01-25 08:28:19	b0155f9d-c871-43c3-a4fb-5fc1b0d82f80	\N	\N	fauzi.enginer2@gmail.com	$2y$10$H2.8UlkXYLP5IajhZhntbORkr4HfFmXAfBeOZNiaX2wveJWutPI5m	2	2024-01-25 08:28:19	1	\N
12	2023-12-28 14:10:00	2023-12-28 14:10:00	9a3d18ee-fe4b-4001-8456-1c937b7210e4	\N	\N	ariel@gmail.com	$2y$10$NOddeLzpO5g2dGARgJF4gOamXb1dBedUY9Y4hMEsxSclWxwNBnzpS	2	2023-12-28 14:10:00	1	\N
\.


--
-- Data for Name: wishlists; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wishlists (id, created_dt, updated_dt, member_id, course_id) FROM stdin;
48	2024-01-16 10:52:44.034	\N	1	3
51	2024-01-23 09:33:50.529	\N	1	2
52	2024-01-23 09:34:03.138	\N	1	6
\.


--
-- Name: actionlogs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.actionlogs_id_seq', 1, false);


--
-- Name: carts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.carts_id_seq', 33, true);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 1, false);


--
-- Name: course_videos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.course_videos_id_seq', 10, true);


--
-- Name: courses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.courses_id_seq', 9, true);


--
-- Name: curriculumns_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.curriculumns_id_seq', 1, false);


--
-- Name: instructors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instructors_id_seq', 9, true);


--
-- Name: members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.members_id_seq', 9, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 29, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 17, true);


--
-- Name: ratings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ratings_id_seq', 32, true);


--
-- Name: subscriptions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.subscriptions_id_seq', 1, true);


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

SELECT pg_catalog.setval('public.users_id_seq', 17, true);


--
-- Name: wishlists_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.wishlists_id_seq', 52, true);


--
-- Name: actionlogs actionlogs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actionlogs
    ADD CONSTRAINT actionlogs_pkey PRIMARY KEY (id);


--
-- Name: carts carts_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_pk PRIMARY KEY (id);


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
-- Name: curriculumns curriculumns_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curriculumns
    ADD CONSTRAINT curriculumns_pkey PRIMARY KEY (id);


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
-- Name: wishlists wishlists_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wishlists
    ADD CONSTRAINT wishlists_unique UNIQUE (id);


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
-- Name: ratings ratings_course_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT ratings_course_id_fkey FOREIGN KEY (course_id) REFERENCES public.courses(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ratings ratings_member_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT ratings_member_id_foreign FOREIGN KEY (member_id) REFERENCES public.members(id) ON UPDATE CASCADE ON DELETE CASCADE;


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

