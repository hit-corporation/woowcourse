--
-- PostgreSQL database dump
--

-- Dumped from database version 14.3
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

SET default_table_access_method = heap;

--
-- Name: actionlog; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.actionlog (
    id integer NOT NULL,
    "user" character varying(20),
    ipadd character varying(20),
    logtime timestamp(6) without time zone DEFAULT ('now'::text)::timestamp without time zone,
    logdetail text,
    info character varying(30)
);


ALTER TABLE public.actionlog OWNER TO postgres;

--
-- Name: actionlog_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.actionlog_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.actionlog_id_seq OWNER TO postgres;

--
-- Name: actionlog_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.actionlog_id_seq OWNED BY public.actionlog.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id integer NOT NULL,
    category_name character varying(240),
    parent_category integer,
    deleted_at timestamp without time zone,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.categories ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: instructor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.instructor (
    id integer NOT NULL,
    first_name character varying(30),
    last_name character varying(30),
    email character varying(100) NOT NULL,
    phone character varying(20),
    photo character varying(255)
);


ALTER TABLE public.instructor OWNER TO postgres;

--
-- Name: instructor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.instructor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.instructor_id_seq OWNER TO postgres;

--
-- Name: instructor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.instructor_id_seq OWNED BY public.instructor.id;


--
-- Name: members; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.members (
    id integer NOT NULL,
    first_name character varying(50),
    last_name character varying(50),
    email character varying,
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone,
    photo character varying DEFAULT 1,
    phone character varying,
    last_login_date timestamp without time zone
);


ALTER TABLE public.members OWNER TO postgres;

--
-- Name: members_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.members_id_seq
    AS integer
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
    AS integer
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
-- Name: ratings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ratings (
    id integer NOT NULL,
    topic_id integer,
    member_id integer,
    rate real,
    coment character varying(500)
);


ALTER TABLE public.ratings OWNER TO postgres;

--
-- Name: ratings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ratings_id_seq
    AS integer
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
    id integer NOT NULL,
    topic_id integer,
    member_id integer,
    instructor_id integer,
    start_date timestamp without time zone,
    end_date timestamp without time zone
);


ALTER TABLE public.subscriptions OWNER TO postgres;

--
-- Name: subscriptions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.subscriptions_id_seq
    AS integer
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
    id integer NOT NULL,
    category_id integer,
    title character varying(255),
    instructor_id integer,
    content_file character varying,
    description character varying,
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone,
    price integer
);


ALTER TABLE public.topics OWNER TO postgres;

--
-- Name: topics_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.topics_id_seq
    AS integer
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
    user_level_id integer NOT NULL,
    user_level_name character varying(50) NOT NULL
);


ALTER TABLE public.user_level OWNER TO postgres;

--
-- Name: user_level_user_level_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_level_user_level_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_level_user_level_id_seq OWNER TO postgres;

--
-- Name: user_level_user_level_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_level_user_level_id_seq OWNED BY public.user_level.user_level_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    userid integer NOT NULL,
    first_name character varying(50),
    password character varying(255),
    user_level smallint,
    last_login timestamp(0) without time zone,
    active smallint,
    photo text,
    email character varying(100),
    last_name character varying(50),
    created_at timestamp without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_userid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_userid_seq OWNER TO postgres;

--
-- Name: users_userid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_userid_seq OWNED BY public.users.userid;


--
-- Name: actionlog id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actionlog ALTER COLUMN id SET DEFAULT nextval('public.actionlog_id_seq'::regclass);


--
-- Name: instructor id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instructor ALTER COLUMN id SET DEFAULT nextval('public.instructor_id_seq'::regclass);


--
-- Name: members id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members ALTER COLUMN id SET DEFAULT nextval('public.members_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


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
-- Name: user_level user_level_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_level ALTER COLUMN user_level_id SET DEFAULT nextval('public.user_level_user_level_id_seq'::regclass);


--
-- Name: users userid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN userid SET DEFAULT nextval('public.users_userid_seq'::regclass);


--
-- Data for Name: actionlog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.actionlog (id, "user", ipadd, logtime, logdetail, info) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, category_name, parent_category, deleted_at, created_at, updated_at) FROM stdin;
1	All	\N	\N	2023-10-31 09:35:07.468638	\N
2	Desain	1	\N	2023-10-31 09:35:44.703211	\N
3	Desain Grafis & Ilustrasi	2	\N	2023-10-31 09:38:13.154745	\N
4	Alat Desain	2	\N	2023-10-31 09:38:24.589781	\N
5	Desain 3D & Animasi	2	\N	2023-10-31 09:39:02.106148	\N
6	Desain Web	2	\N	2023-10-31 09:39:57.456332	\N
7	Pemasaran	1	\N	2023-10-31 09:47:07.388922	\N
8	Pemasaran Digital	7	\N	2023-10-31 09:48:51.346441	\N
9	Optimasi Mesin Pencari	7	\N	2023-10-31 09:49:21.057756	\N
10	Pemasaran Media Sosial	7	\N	2023-10-31 09:49:56.251386	\N
11	Dasar-dasar Pemasaran	7	\N	2023-10-31 09:50:23.881882	\N
12	Analitik dan Otomatisasi Pemasaran	7	\N	2023-10-31 09:51:14.635643	\N
13	Bisnis	1	\N	2023-10-31 09:52:05.870556	\N
14	Kewirausahaan	13	\N	2023-10-31 09:52:34.002624	\N
15	Komunikasi	13	\N	2023-10-31 09:52:53.587966	\N
16	Manajemen	13	\N	2023-10-31 09:53:10.099078	\N
17	Penjualan	13	\N	2023-10-31 09:53:23.631232	\N
18	Strategi Bisnis	13	\N	2023-10-31 09:53:37.60454	\N
19	Desain Interior	2	\N	2023-11-01 09:53:55.765994	\N
\.


--
-- Data for Name: instructor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instructor (id, first_name, last_name, email, phone, photo) FROM stdin;
\.


--
-- Data for Name: members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.members (id, first_name, last_name, email, created_at, updated_at, photo, phone, last_login_date) FROM stdin;
4	ahmad	fauzi	fauzi.enginer@gmail.com	2023-10-26 11:49:22.338979	\N	1	\N	\N
5	ahmad	fauzi	fauzi.enginer2@gmail.com	2023-10-27 10:40:40.392017	\N	1	\N	\N
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2023_11_01_090136_create_actionlog_table	0
2	2023_11_01_090136_create_categories_table	0
3	2023_11_01_090136_create_instructor_table	0
4	2023_11_01_090136_create_members_table	0
5	2023_11_01_090136_create_ratings_table	0
6	2023_11_01_090136_create_subscriptions_table	0
7	2023_11_01_090136_create_topics_table	0
8	2023_11_01_090136_create_user_level_table	0
9	2023_11_01_090136_create_users_table	0
10	2023_11_01_090139_add_foreign_keys_to_categories_table	0
\.


--
-- Data for Name: ratings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ratings (id, topic_id, member_id, rate, coment) FROM stdin;
\.


--
-- Data for Name: subscriptions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subscriptions (id, topic_id, member_id, instructor_id, start_date, end_date) FROM stdin;
\.


--
-- Data for Name: topics; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.topics (id, category_id, title, instructor_id, content_file, description, created_at, updated_at, price) FROM stdin;
\.


--
-- Data for Name: user_level; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_level (user_level_id, user_level_name) FROM stdin;
1	Administrator
3	Guru
4	Murid
2	Tim
10	admin sekolah
5	Orang Tua
6	Kepala Sekolah
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (userid, first_name, password, user_level, last_login, active, photo, email, last_name, created_at) FROM stdin;
2	user	$2y$10$96ZOFWieIlTJdFNIdmSXGeOLKDNIeM4r6kRrfosjxsHjzN8b1bGvy	1	\N	1	\N	user@gmail.com	user	\N
1	admin	$2y$10$hngwULP9Yl6nSptuoRiPJOp0heKo44DTNSI6unxNvtwfYGqtQotfa	1	\N	1	\N	admin@woowcourse.com	admin	\N
5	susilo	$2y$10$Vyg/ZaowBHdeCsWnpbxwk.gib7d3Wd5RA53IujGH0w./cs.VAPLq6	1	\N	1	\N	susilo@gmail.com	bambang	\N
7	omni	$2y$10$HAX5b3Z.HMiszEyakCHQLOGJak22pAwDTCtZYQkVXnYJAF6oxxYIC	1	2023-10-25 03:38:01	1	\N	omnichannelhit@gmail.com	Omnichannel HIT	\N
8	Web	$2y$10$A5A7pR8c35vCdTCQ1QpaguvZB1Kyn9x8wYtINHCQ/6tlqL7S7wFIq	2	2023-10-30 10:48:18	1	\N	fauzi.enginer@gmail.com	Developer	\N
9	ahmad	$2y$10$cV4quyda/78/.xKPAV3eXOgEZ18xDzzzMiRv1qWJdUFpiECp5Uzni	2	2023-10-31 08:51:38	1	\N	fauzi.enginer2@gmail.com	fauzi	\N
\.


--
-- Name: actionlog_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.actionlog_id_seq', 1, false);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 19, true);


--
-- Name: instructor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instructor_id_seq', 1, false);


--
-- Name: members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.members_id_seq', 5, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 10, true);


--
-- Name: ratings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ratings_id_seq', 1, false);


--
-- Name: subscriptions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.subscriptions_id_seq', 1, false);


--
-- Name: topics_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.topics_id_seq', 1, false);


--
-- Name: user_level_user_level_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_level_user_level_id_seq', 1, true);


--
-- Name: users_userid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_userid_seq', 9, true);


--
-- Name: actionlog actionlog_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actionlog
    ADD CONSTRAINT actionlog_pkey PRIMARY KEY (id);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: instructor instructor_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instructor
    ADD CONSTRAINT instructor_pk PRIMARY KEY (id);


--
-- Name: members members_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members
    ADD CONSTRAINT members_pk PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: user_level user_level_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_level
    ADD CONSTRAINT user_level_pk PRIMARY KEY (user_level_id);


--
-- Name: users users_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pk PRIMARY KEY (userid);


--
-- Name: categories_category_name_parent_category_deleted_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX categories_category_name_parent_category_deleted_at ON public.categories USING btree (category_name, parent_category, deleted_at);


--
-- Name: categories categories_parent_category_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_parent_category_fkey FOREIGN KEY (parent_category) REFERENCES public.categories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

