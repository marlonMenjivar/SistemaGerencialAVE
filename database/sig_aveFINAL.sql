/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/06/2015 11:04:44 p.m.                     */
/*==============================================================*/

DROP DATABASE IF EXISTS sigave;
CREATE DATABASE IF NOT EXISTS sigave DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE sigave;

drop table if exists airlines;

drop table if exists branch_offices;

drop table if exists destinies;

drop table if exists etl_users;

drop table if exists fulfillment_branch_office_goals;

drop table if exists goal_airlines;

drop table if exists goal_branch_offices;

drop table if exists invoiced_services;

drop table if exists invoiced_tickets;

drop table if exists itinerary_invoiced_tickets;

drop table if exists operacionesexs;

drop table if exists operacionesrgs;

drop table if exists providers;

drop table if exists routes;

drop table if exists services_sales_providers;

drop table if exists services_sales_types;

drop table if exists tickets_sales_destinies;

drop table if exists tickets_sales_routes;

drop table if exists types;

drop table if exists users;

/*==============================================================*/
/* Table: airlines                                              */
/*==============================================================*/
create table airlines
(
   id                   int(11) not null AUTO_INCREMENT,
   name			        varchar(30) not null,
   abrevia              varchar(3) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: branch_offices                                        */
/*==============================================================*/
create table branch_offices
(
   id                   int(11) not null AUTO_INCREMENT,
   name      			varchar(15) not null,
   abrevia              varchar(3) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: destinies                                             */
/*==============================================================*/
create table destinies
(
   id                   int(11) not null AUTO_INCREMENT,
   tickets_sales_destiny_id int,
   destino              varchar(3),
   boletos_destino      int,
   total_destino        varchar(30),
   primary key (id)
);

/*==============================================================*/
/* Table: etl_users                                             */
/*==============================================================*/
create table etl_users
(
   id                   int(11) not null AUTO_INCREMENT,
   user_id              int,
   username             varchar(20) not null,
   fecha                datetime not null,
   ingreso_desde        date not null,
   ingreso_hasta        date not null,
   cantidad_boletos     int not null,
   cantidad_servicios   int not null,
   total_boletos        float(8,2) not null,
   total_servicios      float(8,2) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: fulfillment_branch_office_goals                       */
/*==============================================================*/
create table fulfillment_branch_office_goals
(
   id                   int(11) not null AUTO_INCREMENT,
   goal_branch_office_id int,
   fecha_inicio         date,
   fecha_fin            date,
   cantidad_boletos     int,
   total_boletos        float(8,2),
   faltante_boletos     float(8,2),
   porcentaje_boletos   float,
   cantidad_servicios   int,
   total_servicios      float(8,2),
   faltante_servicios   float(8,2),
   porcentaje_servicios float,
   primary key (id)
);

/*==============================================================*/
/* Table: goal_airlines                                          */
/*==============================================================*/
create table goal_airlines
(
   id                   int(11) not null AUTO_INCREMENT,
   airline_id           int,
   periodo_bsp          int,
   fecha_inicio       	date,
   fecha_fin            date,
   boletos_periodo      int(11) default '0',
   total_periodo        float(8,2) default '0.00',
   meta_bsp             float(8,2),
   faltante             float(8,2) default '0.00',
   porcentaje           float(8) default '0',
   comision             float(8),
   ingreso_comision     float(8,2) default '0.00',
   `modified` datetime	default null,
   primary key (id)
);

/*==============================================================*/
/* Table: goal_branch_offices                                   */
/*==============================================================*/
create table goal_branch_offices
(
   id                   int(11) not null AUTO_INCREMENT,
   branch_office_id     int,
   mes			        date not null,
   meta_boletos         float(8,2) not null,
   meta_servicios       float(8,2) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: invoiced_services                                     */
/*==============================================================*/
create table invoiced_services
(
   id                   int(11) not null AUTO_INCREMENT,
   services_sales_provider_id int,
   services_sales_type_id int,
   fulfillment_branch_office_goal_id int,
   numero               int,
   fecha                date,
   tipo_servicio        varchar(100),
   proveedor_servicio   varchar(100),
   tarifa               float(8,2),
   iva                  float(8,2),
   pasajero             varchar(60),
   descripcion          varchar(100),
   correlativo_comprobante int,
   tipo_documento       varchar(30),
   sucursal             varchar(15),
   primary key (id)
);

/*==============================================================*/
/* Table: invoiced_tickets                                      */
/*==============================================================*/
create table invoiced_tickets
(
   id                   int(11) not null AUTO_INCREMENT,
   airline_id           int,
   itinerary_invoiced_ticket_id int,
   tickets_sales_destiny_id int,
   tickets_sales_route_id int,
   fulfillment_branch_office_goal_id int,
   boleto               varchar(20) not null,
   fecha                date,
   ruta                 varchar(80),
   destino              varchar(3),
   pasajero             varchar(30),
   tarifa               decimal(12,2),
   fee                  float(8,2),
   complemento          float(8,2),
   coorrelativo_comprobante int,
   tipo_documento       varchar(30),
   sucursal             varchar(15),
   primary key (id)
);

/*==============================================================*/
/* Table: itinerary_invoiced_tickets                            */
/*==============================================================*/
create table itinerary_invoiced_tickets
(
   id                   int(11) not null AUTO_INCREMENT,
   codigo_ciudad1       char(3),
   nombre_ciudad1       varchar(17),
   codigo_ciudad2       char(3),
   nombre_ciudad2       varchar(17),
   pais1                varchar(30),
   pais2                varchar(30),
   primary key (id)
);

/*==============================================================*/
/* Table: operacionesexs                                        */
/*==============================================================*/
create table operacionesexs
(
   id                   int(11) not null AUTO_INCREMENT,
   user_id              int,
   username             varchar(20) not null,
   fecha                datetime not null,
   formcall             varchar(50) not null,
   subcall              varchar(50) not null,
   extostring           varchar(1000) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: operacionesrgs                                        */
/*==============================================================*/
create table operacionesrgs
(
   id                   int(11) not null AUTO_INCREMENT,
   user_id              int,
   username             varchar(20) not null,
   fecha                datetime not null,
   accion               varchar(100) not null,
   comentario           varchar(500) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: providers                                             */
/*==============================================================*/
create table providers
(
   id                   int(11) not null AUTO_INCREMENT,
   services_sales_provider_id int,
   proveedor_servicio   varchar(100),
   cantidad_servicios_proveedor int,
   total_servicios_proveedor float(8,2),
   primary key (id)
);

/*==============================================================*/
/* Table: routes                                                */
/*==============================================================*/
create table routes
(
   id                   int(11) not null AUTO_INCREMENT,
   tickets_sales_route_id int,
   ruta                 varchar(80),
   boletos_ruta         int,
   total_ruta           float(8,2),
   primary key (id)
);

/*==============================================================*/
/* Table: services_sales_providers                              */
/*==============================================================*/
create table services_sales_providers
(
   id                   int(11) not null AUTO_INCREMENT,
   fecha_inicio_proveedor date not null,
   fecha_fin_proveedor  date not null,
   primary key (id)
);

/*==============================================================*/
/* Table: services_sales_types                                  */
/*==============================================================*/
create table services_sales_types
(
   id                   int(11) not null AUTO_INCREMENT,
   fecha_inicio_tipo    date not null,
   fecha_fin_tipo       date not null,
   primary key (id)
);

/*==============================================================*/
/* Table: tickets_sales_destinies                               */
/*==============================================================*/
create table tickets_sales_destinies
(
   id                   int(11) not null AUTO_INCREMENT,
   linea_aerea_destino  char(30) not null,
   fecha_inicio_destino date not null,
   fecha_final_destino  date not null,
   primary key (id)
);

/*==============================================================*/
/* Table: tickets_sales_routes                                  */
/*==============================================================*/
create table tickets_sales_routes
(
   id                   int(11) not null AUTO_INCREMENT,
   linea_aerea_ruta     varchar(20) not null,
   fecha_inicio_ruta    date not null,
   fecha_final_ruta     date not null,
   primary key (id)
);

/*==============================================================*/
/* Table: types                                                 */
/*==============================================================*/
create table types
(
   id                   int(11) not null AUTO_INCREMENT,
   services_sales_type_id int,
   tipo_servicio        varchar(100),
   cantidad_servicios_tipo int,
   total_servicios_tipo float(8,2),
   primary key (id)
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users
(
   id                   int(11) not null AUTO_INCREMENT,
   username             varchar(50) not null,
   password             varchar(255) not null,
   role                 varchar(20) not null,
   created              datetime not null,
   modified             datetime not null,
   name                 varchar(100) not null,
   last_name            varchar(100) not null,
   primary key (id)
);

alter table destinies add constraint fk_reference_24 foreign key (tickets_sales_destiny_id)
      references tickets_sales_destinies (id) on delete restrict on update restrict;

alter table etl_users add constraint fk_reference_25 foreign key (user_id)
      references users (id) on delete restrict on update restrict;

alter table fulfillment_branch_office_goals add constraint fk_reference_19 foreign key (goal_branch_office_id)
      references goal_branch_offices (id) on delete restrict on update restrict;

alter table goal_airlines add constraint fk_reference_26 foreign key (airline_id)
      references airlines (id) on delete restrict on update restrict;

alter table goal_branch_offices add constraint fk_reference_22 foreign key (branch_office_id)
      references branch_offices (id) on delete restrict on update restrict;

alter table invoiced_services add constraint fk_reference_17 foreign key (services_sales_provider_id)
      references services_sales_providers (id) on delete restrict on update restrict;

alter table invoiced_services add constraint fk_reference_18 foreign key (services_sales_type_id)
      references services_sales_types (id) on delete restrict on update restrict;

alter table invoiced_services add constraint fk_reference_21 foreign key (fulfillment_branch_office_goal_id)
      references fulfillment_branch_office_goals (id) on delete restrict on update restrict;

alter table invoiced_tickets add constraint fk_reference_14 foreign key (itinerary_invoiced_ticket_id)
      references itinerary_invoiced_tickets (id) on delete restrict on update restrict;

alter table invoiced_tickets add constraint fk_reference_15 foreign key (tickets_sales_destiny_id)
      references tickets_sales_destinies (id) on delete restrict on update restrict;

alter table invoiced_tickets add constraint fk_reference_16 foreign key (tickets_sales_route_id)
      references tickets_sales_routes (id) on delete restrict on update restrict;

alter table invoiced_tickets add constraint fk_reference_20 foreign key (fulfillment_branch_office_goal_id)
      references fulfillment_branch_office_goals (id) on delete restrict on update restrict;

alter table invoiced_tickets add constraint fk_reference_8 foreign key (airline_id)
      references airlines (id) on delete restrict on update restrict;

alter table operacionesexs add constraint fk_reference_9 foreign key (user_id)
      references users (id) on delete restrict on update restrict;

alter table operacionesrgs add constraint fk_reference_11 foreign key (user_id)
      references users (id) on delete restrict on update restrict;

alter table providers add constraint fk_reference_27 foreign key (services_sales_provider_id)
      references services_sales_providers (id) on delete restrict on update restrict;

alter table routes add constraint fk_reference_23 foreign key (tickets_sales_route_id)
      references tickets_sales_routes (id) on delete restrict on update restrict;

alter table types add constraint fk_reference_28 foreign key (services_sales_type_id)
      references services_sales_types (id) on delete restrict on update restrict;

