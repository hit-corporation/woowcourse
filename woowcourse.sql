PGDMP     -                	    {         
   woowcourse    14.3    14.3 6    ,           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            -           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            .           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            /           1262    132710 
   woowcourse    DATABASE     j   CREATE DATABASE woowcourse WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_Indonesia.1252';
    DROP DATABASE woowcourse;
                postgres    false            �            1259    132726 	   actionlog    TABLE       CREATE TABLE public.actionlog (
    id integer NOT NULL,
    "user" character varying(20),
    ipadd character varying(20),
    logtime timestamp(6) without time zone DEFAULT ('now'::text)::timestamp without time zone,
    logdetail text,
    info character varying(30)
);
    DROP TABLE public.actionlog;
       public         heap    postgres    false            �            1259    132725    actionlog_id_seq    SEQUENCE     �   CREATE SEQUENCE public.actionlog_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.actionlog_id_seq;
       public          postgres    false    214            0           0    0    actionlog_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.actionlog_id_seq OWNED BY public.actionlog.id;
          public          postgres    false    213            �            1259    133258 
   instructor    TABLE     �   CREATE TABLE public.instructor (
    id integer NOT NULL,
    first_name character varying(30),
    last_name character varying(30),
    email character varying(100) NOT NULL,
    phone character varying(20),
    photo character varying(255)
);
    DROP TABLE public.instructor;
       public         heap    postgres    false            �            1259    133257    instructor_id_seq    SEQUENCE     �   CREATE SEQUENCE public.instructor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.instructor_id_seq;
       public          postgres    false    220            1           0    0    instructor_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.instructor_id_seq OWNED BY public.instructor.id;
          public          postgres    false    219            �            1259    133225    members    TABLE     |  CREATE TABLE public.members (
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
    DROP TABLE public.members;
       public         heap    postgres    false            �            1259    133224    members_id_seq    SEQUENCE     �   CREATE SEQUENCE public.members_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.members_id_seq;
       public          postgres    false    216            2           0    0    members_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.members_id_seq OWNED BY public.members.id;
          public          postgres    false    215            �            1259    133269    ratings    TABLE     �   CREATE TABLE public.ratings (
    id integer NOT NULL,
    topic_id integer,
    member_id integer,
    rate real,
    coment character varying(500)
);
    DROP TABLE public.ratings;
       public         heap    postgres    false            �            1259    133268    ratings_id_seq    SEQUENCE     �   CREATE SEQUENCE public.ratings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.ratings_id_seq;
       public          postgres    false    224            3           0    0    ratings_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.ratings_id_seq OWNED BY public.ratings.id;
          public          postgres    false    223            �            1259    133264    subscriptions    TABLE     �   CREATE TABLE public.subscriptions (
    id integer NOT NULL,
    topic_id integer,
    member_id integer,
    instructor_id integer,
    start_date timestamp without time zone,
    end_date timestamp without time zone
);
 !   DROP TABLE public.subscriptions;
       public         heap    postgres    false            �            1259    133263    subscriptions_id_seq    SEQUENCE     �   CREATE SEQUENCE public.subscriptions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.subscriptions_id_seq;
       public          postgres    false    222            4           0    0    subscriptions_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.subscriptions_id_seq OWNED BY public.subscriptions.id;
          public          postgres    false    221            �            1259    133250    topics    TABLE     N  CREATE TABLE public.topics (
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
    DROP TABLE public.topics;
       public         heap    postgres    false            �            1259    133249    topics_id_seq    SEQUENCE     �   CREATE SEQUENCE public.topics_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.topics_id_seq;
       public          postgres    false    218            5           0    0    topics_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.topics_id_seq OWNED BY public.topics.id;
          public          postgres    false    217            �            1259    132719 
   user_level    TABLE     {   CREATE TABLE public.user_level (
    user_level_id integer NOT NULL,
    user_level_name character varying(50) NOT NULL
);
    DROP TABLE public.user_level;
       public         heap    postgres    false            �            1259    132718    user_level_user_level_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_level_user_level_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.user_level_user_level_id_seq;
       public          postgres    false    212            6           0    0    user_level_user_level_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.user_level_user_level_id_seq OWNED BY public.user_level.user_level_id;
          public          postgres    false    211            �            1259    132712    users    TABLE     8  CREATE TABLE public.users (
    userid integer NOT NULL,
    username character varying(50),
    password character varying(255),
    user_level smallint,
    last_login timestamp(0) without time zone,
    active smallint,
    photo text,
    email character varying(100),
    full_name character varying(50)
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    132711    users_userid_seq    SEQUENCE     �   CREATE SEQUENCE public.users_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.users_userid_seq;
       public          postgres    false    210            7           0    0    users_userid_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.users_userid_seq OWNED BY public.users.userid;
          public          postgres    false    209            �           2604    132729    actionlog id    DEFAULT     l   ALTER TABLE ONLY public.actionlog ALTER COLUMN id SET DEFAULT nextval('public.actionlog_id_seq'::regclass);
 ;   ALTER TABLE public.actionlog ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    213    214            �           2604    133261    instructor id    DEFAULT     n   ALTER TABLE ONLY public.instructor ALTER COLUMN id SET DEFAULT nextval('public.instructor_id_seq'::regclass);
 <   ALTER TABLE public.instructor ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    220    220            �           2604    133228 
   members id    DEFAULT     h   ALTER TABLE ONLY public.members ALTER COLUMN id SET DEFAULT nextval('public.members_id_seq'::regclass);
 9   ALTER TABLE public.members ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    216    216            �           2604    133272 
   ratings id    DEFAULT     h   ALTER TABLE ONLY public.ratings ALTER COLUMN id SET DEFAULT nextval('public.ratings_id_seq'::regclass);
 9   ALTER TABLE public.ratings ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    224    223    224            �           2604    133267    subscriptions id    DEFAULT     t   ALTER TABLE ONLY public.subscriptions ALTER COLUMN id SET DEFAULT nextval('public.subscriptions_id_seq'::regclass);
 ?   ALTER TABLE public.subscriptions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    222    222            �           2604    133253 	   topics id    DEFAULT     f   ALTER TABLE ONLY public.topics ALTER COLUMN id SET DEFAULT nextval('public.topics_id_seq'::regclass);
 8   ALTER TABLE public.topics ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            �           2604    132722    user_level user_level_id    DEFAULT     �   ALTER TABLE ONLY public.user_level ALTER COLUMN user_level_id SET DEFAULT nextval('public.user_level_user_level_id_seq'::regclass);
 G   ALTER TABLE public.user_level ALTER COLUMN user_level_id DROP DEFAULT;
       public          postgres    false    211    212    212                       2604    132715    users userid    DEFAULT     l   ALTER TABLE ONLY public.users ALTER COLUMN userid SET DEFAULT nextval('public.users_userid_seq'::regclass);
 ;   ALTER TABLE public.users ALTER COLUMN userid DROP DEFAULT;
       public          postgres    false    209    210    210                      0    132726 	   actionlog 
   TABLE DATA           P   COPY public.actionlog (id, "user", ipadd, logtime, logdetail, info) FROM stdin;
    public          postgres    false    214   z<       %          0    133258 
   instructor 
   TABLE DATA           T   COPY public.instructor (id, first_name, last_name, email, phone, photo) FROM stdin;
    public          postgres    false    220   �<       !          0    133225    members 
   TABLE DATA           z   COPY public.members (id, first_name, last_name, email, created_at, updated_at, photo, phone, last_login_date) FROM stdin;
    public          postgres    false    216   �<       )          0    133269    ratings 
   TABLE DATA           H   COPY public.ratings (id, topic_id, member_id, rate, coment) FROM stdin;
    public          postgres    false    224   =       '          0    133264    subscriptions 
   TABLE DATA           e   COPY public.subscriptions (id, topic_id, member_id, instructor_id, start_date, end_date) FROM stdin;
    public          postgres    false    222   ;=       #          0    133250    topics 
   TABLE DATA           �   COPY public.topics (id, category_id, title, instructor_id, content_file, description, created_at, updated_at, price) FROM stdin;
    public          postgres    false    218   X=                 0    132719 
   user_level 
   TABLE DATA           D   COPY public.user_level (user_level_id, user_level_name) FROM stdin;
    public          postgres    false    212   u=                 0    132712    users 
   TABLE DATA           t   COPY public.users (userid, username, password, user_level, last_login, active, photo, email, full_name) FROM stdin;
    public          postgres    false    210   �=       8           0    0    actionlog_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.actionlog_id_seq', 1, false);
          public          postgres    false    213            9           0    0    instructor_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.instructor_id_seq', 1, false);
          public          postgres    false    219            :           0    0    members_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.members_id_seq', 1, true);
          public          postgres    false    215            ;           0    0    ratings_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.ratings_id_seq', 1, false);
          public          postgres    false    223            <           0    0    subscriptions_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.subscriptions_id_seq', 1, false);
          public          postgres    false    221            =           0    0    topics_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.topics_id_seq', 1, false);
          public          postgres    false    217            >           0    0    user_level_user_level_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.user_level_user_level_id_seq', 1, true);
          public          postgres    false    211            ?           0    0    users_userid_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.users_userid_seq', 3, true);
          public          postgres    false    209            �           2606    132734    actionlog actionlog_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.actionlog
    ADD CONSTRAINT actionlog_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.actionlog DROP CONSTRAINT actionlog_pkey;
       public            postgres    false    214            �           2606    132724    user_level user_level_pk 
   CONSTRAINT     a   ALTER TABLE ONLY public.user_level
    ADD CONSTRAINT user_level_pk PRIMARY KEY (user_level_id);
 B   ALTER TABLE ONLY public.user_level DROP CONSTRAINT user_level_pk;
       public            postgres    false    212                  x������ � �      %      x������ � �      !   Z   x�3�OM�tI-K��/H-�LK,���K�K��K-rH�M���K���4202�54�52V00�2��25���4B�������1P֔+F��� ��T      )      x������ � �      '      x������ � �      #      x������ � �         Y   x�3�tL����,.)J,�/�2�t/-*�2��--�L�2����24�L�R(N���I��2��/J�KW)M�2��N-H�IT�J��qqq ��y         �   x�M��C@ E�3�a-�H�,�:M����b�[����I779wq� ���6��Y��ڵ$���T�(m��Nl�T1"'��n�ѡZ�c����y<�w>.%o��f��y�M��E�/ˑ�Zj�n��[:��q1�(�>��4�+��%��x�c�%v��P�$t�����,��>B�     