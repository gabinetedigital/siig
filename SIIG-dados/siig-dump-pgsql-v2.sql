--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'LATIN1';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: categoria; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE categoria (
    idcategoria bigint NOT NULL,
    sid bigint NOT NULL,
    nome character varying(255) NOT NULL,
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.categoria OWNER TO siig;

--
-- Name: categoria_idcategoria_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE categoria_idcategoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categoria_idcategoria_seq OWNER TO siig;

--
-- Name: categoria_idcategoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE categoria_idcategoria_seq OWNED BY categoria.idcategoria;


--
-- Name: cidade; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE cidade (
    idcidade bigint NOT NULL,
    sid bigint NOT NULL,
    nome character varying(255) NOT NULL,
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.cidade OWNER TO siig;

--
-- Name: cidade_idcidade_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE cidade_idcidade_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cidade_idcidade_seq OWNER TO siig;

--
-- Name: cidade_idcidade_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE cidade_idcidade_seq OWNED BY cidade.idcidade;


--
-- Name: comentario; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE comentario (
    idcomentario bigint NOT NULL,
    evento_idevento bigint NOT NULL,
    sid bigint,
    texto text,
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.comentario OWNER TO siig;

--
-- Name: comentario_idcomentario_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE comentario_idcomentario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comentario_idcomentario_seq OWNER TO siig;

--
-- Name: comentario_idcomentario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE comentario_idcomentario_seq OWNED BY comentario.idcomentario;


--
-- Name: estado; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE estado (
    idestado bigint NOT NULL,
    nome character varying(255) NOT NULL,
    sigla character varying(3) NOT NULL,
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.estado OWNER TO siig;

--
-- Name: estado_idestado_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE estado_idestado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estado_idestado_seq OWNER TO siig;

--
-- Name: estado_idestado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE estado_idestado_seq OWNED BY estado.idestado;


--
-- Name: evento; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE evento (
    idevento bigint NOT NULL,
    sid bigint NOT NULL,
    categoria_idcategoria bigint,
    subcategoria_idsubcategoria bigint,
    titulo character varying(255) NOT NULL,
    texto text,
    assunto character varying(255),
    tags character varying(255),
    datahora timestamp without time zone NOT NULL,
    cidade_idcidade bigint NOT NULL,
    latitude character varying(30),
    longitude character varying(30),
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.evento OWNER TO siig;

--
-- Name: evento_idevento_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE evento_idevento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.evento_idevento_seq OWNER TO siig;

--
-- Name: evento_idevento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE evento_idevento_seq OWNED BY evento.idevento;


--
-- Name: foto; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE foto (
    idfoto bigint NOT NULL,
    comentario_idcomentario bigint NOT NULL,
    sid bigint,
    diretorio character varying(45),
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.foto OWNER TO siig;

--
-- Name: foto_idfoto_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE foto_idfoto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.foto_idfoto_seq OWNER TO siig;

--
-- Name: foto_idfoto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE foto_idfoto_seq OWNED BY foto.idfoto;


--
-- Name: subcategoria; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE subcategoria (
    idsubcategoria bigint NOT NULL,
    categoria_idcategoria bigint NOT NULL,
    sid bigint,
    nome character varying(255),
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.subcategoria OWNER TO siig;

--
-- Name: subcategoria_idsubcategoria_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE subcategoria_idsubcategoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.subcategoria_idsubcategoria_seq OWNER TO siig;

--
-- Name: subcategoria_idsubcategoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE subcategoria_idsubcategoria_seq OWNED BY subcategoria.idsubcategoria;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE usuario (
    idusuario bigint NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    senha character varying(45) NOT NULL,
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.usuario OWNER TO siig;

--
-- Name: usuario_idusuario_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE usuario_idusuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_idusuario_seq OWNER TO siig;

--
-- Name: usuario_idusuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE usuario_idusuario_seq OWNED BY usuario.idusuario;


--
-- Name: video; Type: TABLE; Schema: public; Owner: siig; Tablespace: 
--

CREATE TABLE video (
    idvideo bigint NOT NULL,
    comentario_idcomentario bigint NOT NULL,
    sid bigint,
    url character varying(255),
    ativo smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.video OWNER TO siig;

--
-- Name: video_idvideo_seq; Type: SEQUENCE; Schema: public; Owner: siig
--

CREATE SEQUENCE video_idvideo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.video_idvideo_seq OWNER TO siig;

--
-- Name: video_idvideo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siig
--

ALTER SEQUENCE video_idvideo_seq OWNED BY video.idvideo;


--
-- Name: idcategoria; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY categoria ALTER COLUMN idcategoria SET DEFAULT nextval('categoria_idcategoria_seq'::regclass);


--
-- Name: idcidade; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY cidade ALTER COLUMN idcidade SET DEFAULT nextval('cidade_idcidade_seq'::regclass);


--
-- Name: idcomentario; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY comentario ALTER COLUMN idcomentario SET DEFAULT nextval('comentario_idcomentario_seq'::regclass);


--
-- Name: idestado; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY estado ALTER COLUMN idestado SET DEFAULT nextval('estado_idestado_seq'::regclass);


--
-- Name: idevento; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY evento ALTER COLUMN idevento SET DEFAULT nextval('evento_idevento_seq'::regclass);


--
-- Name: idfoto; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY foto ALTER COLUMN idfoto SET DEFAULT nextval('foto_idfoto_seq'::regclass);


--
-- Name: idsubcategoria; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY subcategoria ALTER COLUMN idsubcategoria SET DEFAULT nextval('subcategoria_idsubcategoria_seq'::regclass);


--
-- Name: idusuario; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY usuario ALTER COLUMN idusuario SET DEFAULT nextval('usuario_idusuario_seq'::regclass);


--
-- Name: idvideo; Type: DEFAULT; Schema: public; Owner: siig
--

ALTER TABLE ONLY video ALTER COLUMN idvideo SET DEFAULT nextval('video_idvideo_seq'::regclass);


--
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: siig
--

INSERT INTO categoria VALUES (4, 1, 'Educação', 1);
INSERT INTO categoria VALUES (9, 1, 'Meio Ambiente', 1);
INSERT INTO categoria VALUES (11, 1, 'Segurança', 1);
INSERT INTO categoria VALUES (13, 1, 'Obras', 1);
INSERT INTO categoria VALUES (3, 1, 'Saúde', 1);
INSERT INTO categoria VALUES (1, 1, 'Cultura', 1);
INSERT INTO categoria VALUES (12, 1, 'Esporte e Lazer', 1);


--
-- Name: categoria_idcategoria_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('categoria_idcategoria_seq', 13, true);


--
-- Data for Name: cidade; Type: TABLE DATA; Schema: public; Owner: siig
--

INSERT INTO cidade VALUES (1, 1, 'Porto Alegre', 1);
INSERT INTO cidade VALUES (2, 1, 'Caxias do Sul', 1);
INSERT INTO cidade VALUES (3, 1, 'Rio Grande', 1);
INSERT INTO cidade VALUES (4, 1, 'Santa Maria', 1);
INSERT INTO cidade VALUES (5, 1, 'Pelotas', 1);


--
-- Name: cidade_idcidade_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('cidade_idcidade_seq', 5, true);


--
-- Data for Name: comentario; Type: TABLE DATA; Schema: public; Owner: siig
--



--
-- Name: comentario_idcomentario_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('comentario_idcomentario_seq', 1, false);


--
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: siig
--

INSERT INTO estado VALUES (1, 'Rio Grande do Sul', 'RS', 1);


--
-- Name: estado_idestado_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('estado_idestado_seq', 1, true);


--
-- Data for Name: evento; Type: TABLE DATA; Schema: public; Owner: siig
--

INSERT INTO evento VALUES (1, 1, 4, 2, 'Inauguração da Escola Municipal de Teste de Cadastro', 'Curabitur eu tortor et velit maximus suscipit. Sed luctus justo sit amet magna hendrerit, non congue dui tincidunt. Morbi non placerat nisl. Morbi dictum metus eget ultricies sagittis. Aliquam ultrices felis at tincidunt sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent sollicitudin lacus dolor, quis mollis dui venenatis sed. Aenean vel tristique nibh, quis lacinia odio. Morbi in erat nunc. 

Curabitur eu tortor et velit maximus suscipit. Sed luctus justo sit amet magna hendrerit, non congue dui tincidunt. Morbi non placerat nisl. Morbi dictum metus eget ultricies sagittis. Aliquam ultrices felis at tincidunt sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent sollicitudin lacus dolor, quis mollis dui venenatis sed. Aenean vel tristique nibh, quis lacinia odio. Morbi in erat nunc. ', 'Inauguração de Escola Municipal', 'escola municipal, porto alegre, inauguração', '2014-12-01 16:10:16', 1, '-30.0133202', '-51.1665476', 1);


--
-- Name: evento_idevento_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('evento_idevento_seq', 1, true);


--
-- Data for Name: foto; Type: TABLE DATA; Schema: public; Owner: siig
--



--
-- Name: foto_idfoto_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('foto_idfoto_seq', 1, false);


--
-- Data for Name: subcategoria; Type: TABLE DATA; Schema: public; Owner: siig
--

INSERT INTO subcategoria VALUES (1, 1, 1, 'Música', 1);
INSERT INTO subcategoria VALUES (2, 4, 1, 'Ensino Fundamental', 1);


--
-- Name: subcategoria_idsubcategoria_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('subcategoria_idsubcategoria_seq', 2, true);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: siig
--

INSERT INTO usuario VALUES (1, 'Admin', 'siig', '8962139b5b7e5eac50294e12b4dbed2a01d5e2ae', 1);


--
-- Name: usuario_idusuario_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('usuario_idusuario_seq', 1, true);


--
-- Data for Name: video; Type: TABLE DATA; Schema: public; Owner: siig
--



--
-- Name: video_idvideo_seq; Type: SEQUENCE SET; Schema: public; Owner: siig
--

SELECT pg_catalog.setval('video_idvideo_seq', 1, false);


--
-- Name: categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (idcategoria);


--
-- Name: cidade_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY cidade
    ADD CONSTRAINT cidade_pkey PRIMARY KEY (idcidade);


--
-- Name: comentario_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY comentario
    ADD CONSTRAINT comentario_pkey PRIMARY KEY (idcomentario);


--
-- Name: estado_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (idestado);


--
-- Name: evento_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY evento
    ADD CONSTRAINT evento_pkey PRIMARY KEY (idevento);


--
-- Name: foto_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY foto
    ADD CONSTRAINT foto_pkey PRIMARY KEY (idfoto);


--
-- Name: subcategoria_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY subcategoria
    ADD CONSTRAINT subcategoria_pkey PRIMARY KEY (idsubcategoria);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (idusuario);


--
-- Name: video_pkey; Type: CONSTRAINT; Schema: public; Owner: siig; Tablespace: 
--

ALTER TABLE ONLY video
    ADD CONSTRAINT video_pkey PRIMARY KEY (idvideo);


--
-- Name: categoria_SID; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "categoria_SID" ON categoria USING btree (sid);


--
-- Name: cidade_SID; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "cidade_SID" ON cidade USING btree (sid);


--
-- Name: comentario_SID; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "comentario_SID" ON comentario USING btree (sid);


--
-- Name: comentario_comentario_FKIndex1; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "comentario_comentario_FKIndex1" ON comentario USING btree (evento_idevento);


--
-- Name: evento_SID; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "evento_SID" ON evento USING btree (sid);


--
-- Name: evento_catid; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX evento_catid ON evento USING btree (categoria_idcategoria);


--
-- Name: evento_cidid; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX evento_cidid ON evento USING btree (cidade_idcidade);


--
-- Name: evento_subid; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX evento_subid ON evento USING btree (subcategoria_idsubcategoria);


--
-- Name: foto_SID; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "foto_SID" ON foto USING btree (sid);


--
-- Name: foto_foto_FKIndex1; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "foto_foto_FKIndex1" ON foto USING btree (comentario_idcomentario);


--
-- Name: subcategoria_SID; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "subcategoria_SID" ON subcategoria USING btree (sid);


--
-- Name: subcategoria_subcategoria_FKIndex1; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "subcategoria_subcategoria_FKIndex1" ON subcategoria USING btree (categoria_idcategoria);


--
-- Name: video_SID; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "video_SID" ON video USING btree (sid);


--
-- Name: video_video_FKIndex1; Type: INDEX; Schema: public; Owner: siig; Tablespace: 
--

CREATE INDEX "video_video_FKIndex1" ON video USING btree (comentario_idcomentario);


--
-- Name: comentario_evento_idevento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: siig
--

ALTER TABLE ONLY comentario
    ADD CONSTRAINT comentario_evento_idevento_fkey FOREIGN KEY (evento_idevento) REFERENCES evento(idevento);


--
-- Name: foto_comentario_idcomentario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: siig
--

ALTER TABLE ONLY foto
    ADD CONSTRAINT foto_comentario_idcomentario_fkey FOREIGN KEY (comentario_idcomentario) REFERENCES comentario(idcomentario);


--
-- Name: subcategoria_categoria_idcategoria_fkey; Type: FK CONSTRAINT; Schema: public; Owner: siig
--

ALTER TABLE ONLY subcategoria
    ADD CONSTRAINT subcategoria_categoria_idcategoria_fkey FOREIGN KEY (categoria_idcategoria) REFERENCES categoria(idcategoria);


--
-- Name: video_comentario_idcomentario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: siig
--

ALTER TABLE ONLY video
    ADD CONSTRAINT video_comentario_idcomentario_fkey FOREIGN KEY (comentario_idcomentario) REFERENCES comentario(idcomentario);


--
-- Name: public; Type: ACL; Schema: -; Owner: siig
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM siig;
GRANT ALL ON SCHEMA public TO siig;


--
-- PostgreSQL database dump complete
--

