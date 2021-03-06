PGDMP         %                x            Photo_gallery    9.6.17    12.2 *    |           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            }           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ~           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16393    Photo_gallery    DATABASE     �   CREATE DATABASE "Photo_gallery" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Russian_Russia.1251' LC_CTYPE = 'Russian_Russia.1251';
    DROP DATABASE "Photo_gallery";
                postgres    false            �            1259    16396    comments    TABLE     �   CREATE TABLE public.comments (
    comment_id integer NOT NULL,
    login character varying(500) NOT NULL,
    photo_id integer NOT NULL,
    comment_text text NOT NULL
);
    DROP TABLE public.comments;
       public            postgres    false            �            1259    16394    comments_comment_id_seq    SEQUENCE     �   CREATE SEQUENCE public.comments_comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.comments_comment_id_seq;
       public          postgres    false    186            �           0    0    comments_comment_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.comments_comment_id_seq OWNED BY public.comments.comment_id;
          public          postgres    false    185            �            1259    16410    photos    TABLE     �   CREATE TABLE public.photos (
    photo_id integer NOT NULL,
    login character varying(500) NOT NULL,
    photo_way character varying(500) NOT NULL,
    description character varying(2000)
);
    DROP TABLE public.photos;
       public            postgres    false            �            1259    16408    photos_photo_id_seq    SEQUENCE     |   CREATE SEQUENCE public.photos_photo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.photos_photo_id_seq;
       public          postgres    false    188            �           0    0    photos_photo_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.photos_photo_id_seq OWNED BY public.photos.photo_id;
          public          postgres    false    187            �            1259    16423    ratings    TABLE     �   CREATE TABLE public.ratings (
    rating_id integer NOT NULL,
    login character varying(500) NOT NULL,
    photo_id integer NOT NULL,
    rating_point integer NOT NULL
);
    DROP TABLE public.ratings;
       public            postgres    false            �            1259    16421    ratings_rating_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.ratings_rating_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.ratings_rating_id_seq;
       public          postgres    false    190            �           0    0    ratings_rating_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.ratings_rating_id_seq OWNED BY public.ratings.rating_id;
          public          postgres    false    189            �            1259    16435    users    TABLE     �   CREATE TABLE public.users (
    name character varying(500) NOT NULL,
    login character varying(500) NOT NULL,
    password character varying(500) NOT NULL,
    email character varying(500),
    avatar character varying(500)
);
    DROP TABLE public.users;
       public            postgres    false            �           2604    16399    comments comment_id    DEFAULT     z   ALTER TABLE ONLY public.comments ALTER COLUMN comment_id SET DEFAULT nextval('public.comments_comment_id_seq'::regclass);
 B   ALTER TABLE public.comments ALTER COLUMN comment_id DROP DEFAULT;
       public          postgres    false    186    185    186            �           2604    16413    photos photo_id    DEFAULT     r   ALTER TABLE ONLY public.photos ALTER COLUMN photo_id SET DEFAULT nextval('public.photos_photo_id_seq'::regclass);
 >   ALTER TABLE public.photos ALTER COLUMN photo_id DROP DEFAULT;
       public          postgres    false    188    187    188            �           2604    16426    ratings rating_id    DEFAULT     v   ALTER TABLE ONLY public.ratings ALTER COLUMN rating_id SET DEFAULT nextval('public.ratings_rating_id_seq'::regclass);
 @   ALTER TABLE public.ratings ALTER COLUMN rating_id DROP DEFAULT;
       public          postgres    false    189    190    190            t          0    16396    comments 
   TABLE DATA           M   COPY public.comments (comment_id, login, photo_id, comment_text) FROM stdin;
    public          postgres    false    186   b/       v          0    16410    photos 
   TABLE DATA           I   COPY public.photos (photo_id, login, photo_way, description) FROM stdin;
    public          postgres    false    188   �0       x          0    16423    ratings 
   TABLE DATA           K   COPY public.ratings (rating_id, login, photo_id, rating_point) FROM stdin;
    public          postgres    false    190   �2       y          0    16435    users 
   TABLE DATA           E   COPY public.users (name, login, password, email, avatar) FROM stdin;
    public          postgres    false    191   3       �           0    0    comments_comment_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.comments_comment_id_seq', 32, true);
          public          postgres    false    185            �           0    0    photos_photo_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.photos_photo_id_seq', 20, true);
          public          postgres    false    187            �           0    0    ratings_rating_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.ratings_rating_id_seq', 30, true);
          public          postgres    false    189            �           2606    16404    comments pk_comments 
   CONSTRAINT     Z   ALTER TABLE ONLY public.comments
    ADD CONSTRAINT pk_comments PRIMARY KEY (comment_id);
 >   ALTER TABLE ONLY public.comments DROP CONSTRAINT pk_comments;
       public            postgres    false    186            �           2606    16418    photos pk_photos 
   CONSTRAINT     T   ALTER TABLE ONLY public.photos
    ADD CONSTRAINT pk_photos PRIMARY KEY (photo_id);
 :   ALTER TABLE ONLY public.photos DROP CONSTRAINT pk_photos;
       public            postgres    false    188            �           2606    16431    ratings pk_ratings 
   CONSTRAINT     W   ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT pk_ratings PRIMARY KEY (rating_id);
 <   ALTER TABLE ONLY public.ratings DROP CONSTRAINT pk_ratings;
       public            postgres    false    190            �           2606    16442    users pk_users 
   CONSTRAINT     O   ALTER TABLE ONLY public.users
    ADD CONSTRAINT pk_users PRIMARY KEY (login);
 8   ALTER TABLE ONLY public.users DROP CONSTRAINT pk_users;
       public            postgres    false    191            �           1259    16407    Photos-Comments_FK    INDEX     M   CREATE INDEX "Photos-Comments_FK" ON public.comments USING btree (photo_id);
 (   DROP INDEX public."Photos-Comments_FK";
       public            postgres    false    186            �           1259    16433    Photos-Retings_FK    INDEX     K   CREATE INDEX "Photos-Retings_FK" ON public.ratings USING btree (photo_id);
 '   DROP INDEX public."Photos-Retings_FK";
       public            postgres    false    190            �           1259    16406    User-Comments_FK    INDEX     H   CREATE INDEX "User-Comments_FK" ON public.comments USING btree (login);
 &   DROP INDEX public."User-Comments_FK";
       public            postgres    false    186            �           1259    16420    Users-Photos_FK    INDEX     E   CREATE INDEX "Users-Photos_FK" ON public.photos USING btree (login);
 %   DROP INDEX public."Users-Photos_FK";
       public            postgres    false    188            �           1259    16434    Users-Ratings_FK    INDEX     G   CREATE INDEX "Users-Ratings_FK" ON public.ratings USING btree (login);
 &   DROP INDEX public."Users-Ratings_FK";
       public            postgres    false    190            �           1259    16405    comments_pk    INDEX     M   CREATE UNIQUE INDEX comments_pk ON public.comments USING btree (comment_id);
    DROP INDEX public.comments_pk;
       public            postgres    false    186            �           1259    16419 	   photos_pk    INDEX     G   CREATE UNIQUE INDEX photos_pk ON public.photos USING btree (photo_id);
    DROP INDEX public.photos_pk;
       public            postgres    false    188            �           1259    16432 
   ratings_pk    INDEX     J   CREATE UNIQUE INDEX ratings_pk ON public.ratings USING btree (rating_id);
    DROP INDEX public.ratings_pk;
       public            postgres    false    190            �           1259    16443    users_pk    INDEX     B   CREATE UNIQUE INDEX users_pk ON public.users USING btree (login);
    DROP INDEX public.users_pk;
       public            postgres    false    191            �           2606    16444 %   comments FK_COMMENTS_PHOTOS-CO_PHOTOS    FK CONSTRAINT     �   ALTER TABLE ONLY public.comments
    ADD CONSTRAINT "FK_COMMENTS_PHOTOS-CO_PHOTOS" FOREIGN KEY (photo_id) REFERENCES public.photos(photo_id) ON UPDATE RESTRICT ON DELETE RESTRICT;
 Q   ALTER TABLE ONLY public.comments DROP CONSTRAINT "FK_COMMENTS_PHOTOS-CO_PHOTOS";
       public          postgres    false    186    2032    188            �           2606    16449 $   comments FK_COMMENTS_USER-COMM_USERS    FK CONSTRAINT     �   ALTER TABLE ONLY public.comments
    ADD CONSTRAINT "FK_COMMENTS_USER-COMM_USERS" FOREIGN KEY (login) REFERENCES public.users(login) ON UPDATE RESTRICT ON DELETE RESTRICT;
 P   ALTER TABLE ONLY public.comments DROP CONSTRAINT "FK_COMMENTS_USER-COMM_USERS";
       public          postgres    false    191    186    2039            �           2606    16454     photos FK_PHOTOS_USERS-PHO_USERS    FK CONSTRAINT     �   ALTER TABLE ONLY public.photos
    ADD CONSTRAINT "FK_PHOTOS_USERS-PHO_USERS" FOREIGN KEY (login) REFERENCES public.users(login) ON UPDATE RESTRICT ON DELETE RESTRICT;
 L   ALTER TABLE ONLY public.photos DROP CONSTRAINT "FK_PHOTOS_USERS-PHO_USERS";
       public          postgres    false    191    2039    188            �           2606    16459 #   ratings FK_RATINGS_PHOTOS-RE_PHOTOS    FK CONSTRAINT     �   ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT "FK_RATINGS_PHOTOS-RE_PHOTOS" FOREIGN KEY (photo_id) REFERENCES public.photos(photo_id) ON UPDATE RESTRICT ON DELETE RESTRICT;
 O   ALTER TABLE ONLY public.ratings DROP CONSTRAINT "FK_RATINGS_PHOTOS-RE_PHOTOS";
       public          postgres    false    188    190    2032            �           2606    16464 "   ratings FK_RATINGS_USERS-RAT_USERS    FK CONSTRAINT     �   ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT "FK_RATINGS_USERS-RAT_USERS" FOREIGN KEY (login) REFERENCES public.users(login) ON UPDATE RESTRICT ON DELETE RESTRICT;
 N   ALTER TABLE ONLY public.ratings DROP CONSTRAINT "FK_RATINGS_USERS-RAT_USERS";
       public          postgres    false    191    2039    190            t   �  x�uR�N�@��� ��\�@�@)�"
$�t�QA�h(��D2Q9N����1w�9�	������ݵ'�o�!�r�{�\����?ih��7~�X�iI�l:<�4QF[>��q<�xA1�(��݇�}W��G���	lC�
�Ń�&Z�Ȋ��\�Z�P̡ԾC+u�g����ER7]��W)W<��%.:w�>@��^X�Q�]�_��\���>�����<}�߇�o��x9VL(���Gʘ*����<5��bllġ���Y�Q�-�IQ�!zF<S�RD�ۊ�Ano0,D��ȝp��A9ן[��<�"������,��m�D�9��W0�}�͹ͶsL��fE�6��)�b\�8��JޜI)���      v   �  x���J�@�י���3����uQnWIl�J�����B���R���W8�F�*-��ЭHH�����Bd�T;��j�a�يk�Ҡ��D��l�)�0(C���7�%:)ﴷ��P�Z��h��P�y�b�L{{��[s�(,Z�0xp��&X��(~�Ȩ��?�Q`�6��
�tV�D	��x7��Ii��f̤Q�|f	J*�0o�R�8�����
����?�ԟ�:�!eB�t�3�٬G�;J)�z䩾�� �"N\n�|d��F�xB��j�_2��3��z��R�SD�����u���{ۧ7.j�z)�+w��W�uR���-d�K'(��DAPi6r�.�����J�[����ٟ������ղ�	�R�      x   �   x�E�;�@Dk8�`����i,9�%+E���aep7O3� �|�!C���[��av`u
��g?���;I�����%妌��PSه*:�B�P,Cv��tn��vpAo�mA�@,�<W��eE�_D�^"�w;�      y   �  x���ˊA���OU�Օจ���
���2�I��I�q�w� ".|!�üC�yBaqW�:���sI��wڤk2�\[�H�
a@	|r�
XνRv^��-V�>���t�运�<\�I����}��Ek���r�`�Q����={~�8�����#��]�o�]�n1:��d�k����k��0D�M+�ȍ�=*�� �0�������#�Kd�$�Ӡ�`��3��h ct,&�3��ifMC9��"�ଥ`0��.�5v�8��?u�>U�kM�2(X!cX(4�A:i��~0��]y���ȑ�qh��{5�h#�R�y����� �?N�b��y��?#��*����W:+����Ah�?�>�yߐ��q�@$i
F'�9�+�sc��Iww�2�O2;ʲ�/~���     