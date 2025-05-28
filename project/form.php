<!DOCTYPE html>
<html lang="ru"> 
<head> 
    	<title>project_8</title>
	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- link -->
 <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <script
            src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
	<link rel="stylesheet" href="bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="slick/slick.css">
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
	<link href="stylemain.css" rel="stylesheet" type="text/css">

	<!-- script -->

	<script src="jquery-3.4.1.min.js" defer></script>
	<script src="slick/slick.min.js" defer></script>
	<script src="project.js" defer></script>
	<?php
$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
?>
</head>
<body>
<header>
 	<section id="block-support-main" class="block blockh block-block-content block-block-content2f979322-24f2-4ba0-a45e-930ca3dc84a6 clearfix">
      		<div class=""><div class="video">
        		<div class="vid_bg"></div>
        			<video autoplay="autoplay" loop="" class="fillWidth" playsinline preload="auto" muted>
           				<source src="foto/video.mp4" type="video/mp4" >
           				Video lost
          			</video>
          			<img src="foto/MaskGroup.png" class="mkg" alt="" >
		<div class="mt-5 mb-5 header">
        	<div class="container4">
        	<div class="mb-5 navbar t">
        		<img class="rupal-coder" src="foto/Group9.png" alt="" > 
               			<a href="#" style="text-decoration: underline; color: #fff; text-decoration-color: #f14d34; text-decoration-thickness: 2px">Поддержка Drupal</a>
        		<div class="line1"></div>
        	<div class="dropdown">
  			<button class="dropbtn">Администрирование
   			<i class="fa fa-caret-down"></i></button>
  		<div class="dropdown-content">
	     		<a href="#">Миграция</a>
		    	<a href="#">Бэкапы</a>
		    	<a href="#">Аудит безопасности</a>
		    	<a href="#">Оптимизация скорости</a>
		    	<a href="#">Переезд на HTTPS</a>
  		</div>
		</div>
	                <a href="#">Продвижение</a>
	                <a href="#">Реклама</a>
		<div class="dropdown">
                  
  			<button class="dropbtn"> О нас
 			<i class="fa fa-caret-down"></i></button>
			
  		<div class="dropdown-content">
		     	<a href="#team">Команда</a>
			<a href="#">Drupalgive</a>
			<a href="#">Блог</a>
			<a href="#">Курсы Drupal</a>
  		</div>
		</div> 
	                <a href="#">Проект</a>
	                <a href="#">Контакты</a>
        	</div>
       	 	<div class="content-flex">
                <div class="mx-auto mx-5 header_title">
		<div class="center ml-3">
		<div class="ptitle">
                    Поддержка<br >
                    сайтов на Drupal
                </div>
        	<div class="ptext">Сопровождение и поддержка сайтов<br >на CMS Drupal любых версий и запущенности</div></div>
                	<p><button class="my-5 ml-1 mx-auto header_button">
                	<div>
                        	<a href="#tarif11" style="color: #fff; text-decoration: none">ТАРИФЫ</a>
                      	</div>
                    	</button></p>
                </div>

                <div class="my-auto pt-4  header_box">
                <div>
                    	<div class="headbl header_block_text">#1<img src="foto/cup.png" alt=""></div>
                    	<div class="headbltext">Drupal-разработчик в России по версии Рейтинга Рунета</div>
                </div>
                <div>
                   	<div class="headbl">3+</div>
                    	<div class="headbltext">средний опыт специалистов более 3 лет</div>
                </div>
                <div>
                    	<div class="headbl">14</div>
                    	<div class="headbltext">лет опыта в сфере Drupal</div>
		</div>
                  <div>
		
                    <div class="headbl">200+</div>
                    <div class="headbltext">модулей и тем в формате DrupalGive</div>
                  </div>
                  <div>
                    <div class="headbl">35 000</div>
                    <div class="headbltext">часов поддержки сайтов на Drupal</div>
                  </div>
                  <div>
                    <div class="headbl">200+</div>
                    <div class="headbltext">Проектов на поддержке</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</header>  
<!--Меню для phone -->
	<div class="mobile_head_menu">
      		<div class="container">
        		<img src="foto/Group9.png" alt="" >
        	<div class="mob_menu">
          		<div class="mob_menu_1"></div>
        	</div>
      		</div>
    	</div>
<nav>
      <ul class="menu">
        <li>ПОДДЕРЖКА DRUPAL</li>
        <li class="menu_podcat">		
          <span>АДМИНИСТРИРОВАНИЕ</span>
          <ul>
            <li href="#">МИГРАЦИЯ</li>
           <li href="#">БЭКАПЫ</li>
            <li href="#">АУДИТ БЕЗОПАСНОСТИ</li>
           <li href="#">ОПТИМИЗАЦИЯ СКОРОСТИ</li>
            <li href="#">ПЕРЕЕЗД НА HTTPS</li>
          </ul>
        </li>
       <li href="#">ПРОДВИЖЕНИЕ</li>
        <li href="#">РЕКЛАМА</li>
        <li class="menu_podcat">
          <span>О НАС</span>
          <ul>
           <li href="#">КОМАНДА</li>
            <li href="#">DRUPALGIVE</li>
           <li href="#">БЛОГ</li>
           <li href="#">КУРСЫ DRUPAL</li>
          </ul>
        </li>
       <li href="#">ПРОЕКТЫ</li>
       <li href="#">КОНТАКТЫ</li>
      </ul>
    </nav>
<!-- Сетка 4х2-->
	 <div class="main">
	<div>
        <section class="about">
          <div class="mt-5 container">
            <div class="container-fluid row">
              <div class="col-12 col-md-6">
                <h2 class="text-left text-uppercase">13 лет совершенствуем компетенции в Друпал поддержке!</h2>
                <div class="pt-3 pb-5">
                  <p>Разрабатываем и оптимизируем модели, расширяем функциональность сайтов, обновляем дизайн</p>
                </div>
              </div>
            </div>
		 <div class="container-fluid row"> 
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="" >
                  <img src="foto/competency-1.svg" alt="картинка 1" >
                </div>
                <p class="text-left">	
                  Добавление <br >
                  информации на сайт, <br >создание новых <br >
                  разделов
                </p>
              </div>
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="foto" >
                  <img src="foto/competency-2.svg" alt="картинка 2" >
                </div>
                <p class="text-left">
                  Разработка <br >и оптимизация<br >
                  модулей сайта
                </p>
              </div>
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="foto" >
                  <img src="foto/competency-3.svg" alt="картинка 3" >
                </div>
                <p class="text-left">
                  Интеграция с CRM,<br >
                  1С, платежными <br >системами, любыми<br >
                  веб-сервисами
                </p>
              </div>
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="foto" >
                  <img src="foto/competency-4.svg" alt="картинка 4" >
                </div>
                <p class="text-left">
                  Любые доработки<br >
                  функционала <br >и дизайна
                </p>
              </div> 
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="foto" >
                  <img src="foto/competency-5.svg" alt="картинка 5" >
                </div>
                <p class="text-left">Аудит и мониторинг <br >безопасности Drupal <br >сайтов</p>
              </div>
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="" >
                  <img src="foto/competency-6.svg" alt="картинка 6" >
                </div>
                <p class="text-left">Миграция, импорт <br >контента и апгрейд <br >Drupal</p>
              </div>
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="" >
                  <img src="foto/competency-7.svg" alt="картинка 7" >
                </div>
                <p class="text-left">Оптимизация <br >и ускорение <br >Drupal сайтов</p>
              </div>
              <div class="col-sm-3 col-6">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="" >
                  <img src="foto/competency-8.svg" alt="картинка 8" >
                </div>
                <p class="text-left">Веб-маркетинг, <br >консультации <br >и работы по SEO</p>
              </div>
            </div>
          </div>
        </section>
      </div>
 <!-- 8 Блоков -->
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-4 mt-5">
            <h2 class="text-center">
              Поддержка <br >
              от Drupal-coder
            </h2>
          </div>
        </div>
	<div class="container-fluid row"> 
        <div class="mb-5 ml-2 mr-2 row row-flex advantages-row poddr">   
          <div class="block col-12 col-md-3 mb-2 ml-1 mx-auto">
            <p>01.</p>
            <h5>Постановка задачи по Email</h5>
            <div class="text">Удобная и привычная модель постановки задач, при которой задачи фиксируются и никогда не теряются.</div>
            <div class="iconss"><img src="foto/support1.svg" alt=""></div>
          </div>

          <div class="block col-12 col-md-3 mb-2 ml-1 mx-auto">
            <p>02.</p>
            <h5>Система Helpdesk – отчетность, прозрачность</h5>
            <div class="text">Возможность посмотреть все заявки в работе и отработанные часы в личном кабинете через браузер. Более 122737 тикетов уже выполнено!</div>
            <div class="iconss"><img src="foto/support2.svg" alt=""></div>
          </div>
          <div class="block col-12 col-md-3  mb-2 ml-1 mx-auto">
            <p>03.</p>
            <h5>Расширенная техническая поддержка</h5>
            <div class="text">Возможность организации расширенной техподдержки с 6:00 до 22:00 без выходных.</div>
            <div class="iconss"><img src="foto/support3.svg" alt=""></div>
          </div>
          <div class="block col-12 col-md-3 mb-2 ml-1 mx-auto">
            <p>04.</p>
            <h5>Персональный менеджер проекта</h5>
            <div class="text">Ваш менеджер проекта всегда в курсе текущего состояния проекта и в любой момент готов ответить на любые вопросы.</div>
            <div class="iconss"><img src="foto/support4.svg" alt=""></div>
          </div>
          <div class="block col-12 col-md-3  mb-2 ml-1 mx-auto">
            <p>05.</p>
            <h5>Удобные способы оплаты</h5>
            <div class="text">Безналичный расчет по договору или электронные деньги: WebMoney, Яндекс.Деньги, Paypal.</div>
            <div class="iconss"><img src="foto/support5.svg" alt=""></div>
          </div>
          <div class="block col-12 col-md-3 mb-2 ml-1 mx-auto">
            <p>06.</p>
            <h5>Работаем с SLA и NDA</h5>
            <div class="text">Работа в рамках соглашений о конфиденциальности и об уровне качества работ.</div>
            <div class="iconss"><img src="foto/support6.svg" alt=""></div>
          </div>
          <div class="block col-12 col-md-3  mb-2 ml-1 mx-auto">
            <p>07.</p>
            <h5>Штатные специалисты</h5>
            <div class="text">Надежные штатные специалисты, никаких фрилансеров.</div>
            <div class="iconss"><img src="foto/support7.svg" alt=""></div>
          </div>
          <div class="block col-12 col-md-3  mb-2 ml-1 mx-auto">
            <p>08.</p>
            <h5>Удобные каналы связи</h5>
            <div class="text">Консультации по телефону, скайпу, в мессенджерах.</div>
            <div class="iconss"><img src="foto/support8.svg" alt=""></div>
          </div>
        </div>
	</div>
      </div>  
<!-- laptop -->
		 <div class="fon">
<section class="laptop">

          <img src="foto/MaskGroup.png" class="mkg" alt="">
            <div class="container1">
              <div class="row d-flex ffw justify-content-between">
                <div>
                  <img src="foto/laptop.png" class="laptop_img" alt="laptop" >
                </div>
                <div class="row ffw2">
                  <div class="pl-5 text-laptop col-sm-6 col-xs-12">
                    <h1>Экспертиза в Drupal,</h1>
			 <h1>опыт 14 лет!</h1>
                        <div class="mt-4 laptop_box">
				<div class="row">
                          <div class="mr-4 boxred col-12 col-md-4">
                           <p>
                              Только системный подход- <br >контроль версий,<br >
                              резервирование <br >
                              и тестирование!
                            </p>
                          </div>
                          <div class="boxred col-12 col-md-4">
                            <p>
                              Только в Drupal сайты,<br >
                              не берем на поддержку сайты<br >
                              на других CMS!
                            </p>
                          </div>
			</div>
			</div>
			 <div class="mt-4 laptop_box">
				<div class="row">
				  <div class="mr-4 boxred col-12 col-md-4">
                            <p>
                              Участвуем в разработке <br >ядра Drupal и модулей на<br >
                              Drupal.org, разрабатываем <br > 
				    свои модули Drupal!
                            </p>
                          </div>
			 <div class="boxred col-12 col-md-4">
                            <p>
                              Поддерживаем сайты на<br >
                              Drupal 5,6,7 и 8
                            </p>
			 </div>
                          </div>
                        </div>
			</div>
                    </div>
                  </div>
                </div>
		 
	   </section>
</div>
 <!--Тарифы-->
	  <div id="tarif11"> </div>
        <section class="p-md-5 fon_tariff1">
          <h2 class="m-5 pt-5 block-title text-center">Тарифы</h2>
          <div id="tarif">
            <div class="tariffs">
              <div class="fon_tariff">
                <div class="container">
                  <div class="row row-flex tariffs-row">
                    <div class="mb-5 col-md-4 col-12">
                      <div class="tariff">
                        <div class="tariff-header">
                          <h3 class="tariff-title pt-5 pl-4">Стартовый</h3>

                          <div class="line2 bg2"></div>
                        </div>
                        <div class="tariff-body">
                          <ol>
                            <li><i class="arrow down"></i>Консультации и работы по SEO</li>
                            <li>Услуги дизайнера</li>
                            <li>Неиспользованные оплаченные часы переносятся на следующий месяц</li>
			    <li>Предоплата от 6 000 рублей в месяц</li>
                          </ol>
                        </div>
                        <div class="pb-4 tariff-footer">
                          <a href="#footer" class="py-3 btn btn-itd text-uppercase">Оставить заявку</a>
                        </div>
                      </div>
                    </div>
                    <div class="mb-5 col-md-4 col-12">
                      <div class="tariff">
                        <div class="tariff-header">
                          <h3 class="tariff-title pt-5 pl-4">Бизнес</h3>

                          <div class="line2 bg2"></div>
                        </div>
                        <div class="tariff-body">
                          <ol>
                            <li>Консультации и работы по SEO</li>
                            <li>Услуги дизайнера</li>
                            <li>Высокое время реакции – до 2 рабочих дней</li>
                            <li>Неиспользованные оплаченные часы не переносятся</li>
			    <li>Предоплата от 30 000 рублей в месяц</li>
                          </ol>
                        </div>
                        <div class="pb-4 tariff-footer">
                          <a href="#footer" class="py-3 btn btn-itd text-uppercase">Оставить заявку</a>
                        </div>
                      </div>
                    </div>

                    <div class="mb-5 col-md-4 col-12">
                      <div class="tariff">
                        <div class="tariff-header">
                          <h3 class="tariff-title pt-5 pl-4">VIP</h3>


                          <div class="line2 bg2"></div>
                        </div>
                        <div class="tariff-body">
                          <ol>
                            <li>Консультации и работы по SEO</li>
                            <li>Услуги дизайнера</li>
                            <li>Максимальное время реакции - в день обращения</li>
                            <li>Неиспользованные оплаченные часы не переносятся</li>
			    <li>Предоплата от 270 000 рублей в месяц</li>
                          </ol>
                        </div>
                        <div class="pb-4 tariff-footer">
                          <a href="#footer" class="py-3 btn btn-itd text-uppercase">Оставить заявку</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="mt-5 d-flex justify-content-center">
                    <div class="tariffs-ps">
                      Вам не подходят наши тарифы? Оставьте заявку и мы
                      <br >предложим вам индивидуальные условия!
                      <p>
                        <a href="#footer" class="tariff-individ">ПОЛУЧИТЬ ИНДИВИДУАЛЬНЫЙ ТАРИФ</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

<!--  разрабы -->
	 <div class="container">
            <div class="container-fluid row">
                <h3 class="text-left text-uppercase mt-5">Наши профессиональные разработчики<br>
			выполняют быстро любые задачи</h3>
            </div>
            <div class="row"> 
              <div class="col-md-3 col-8 mx-auto mt-5">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="" >
                  <img src="foto/competency-20.svg" alt="картинка 20" >
                </div>
                <p class="text-uppercase">
		 <h5>от 1ч</h5>
                  Настройка события GA в интернет-магазине
                </p>
              </div>
              <div class="col-md-3 col-8 mx-auto mt-5">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="foto" >
                  <img src="foto/competency-21.svg" alt="картинка 21" >
                </div>
                <p class="text-uppercase">
		 <h5>от 20ч</h5>
                  Разработка мобильной версии сайта
                </p>
              </div>
              <div class="col-md-3 col-8 mx-auto mt-5">
                <div class="dd1">
                  <img src="foto/dd.png" class="dd" alt="foto">
                  <img src="foto/competency-22.svg" alt="картинка 22" >
                </div>	  
		 <p class="text">
		 <h5>от 8ч</h5>
                  Интеграция модуля оплаты
                </p>
              </div>
	    </div>
	 </div>
	
  <div class="mt-5 container">
        <div class="row">
          <div class="col-md-12 mb-md-4 mt-md-5">
            <h2 class="text-center">
              Команда
            </h2>
          </div>
        </div>

   <div class="container-fluid row"> 
              <div class="col-md-4 col-6 mt-2 mb-2">	  
	  <img src="foto/IMG_2472_0.jpg"  class="img-fluid" alt="img1" >
	   <h5>Сергей Синица</h5>	
	 <div class="text">Руководитель отдела веб-<br >
		 разработки, канд. техн. наук,<br >
		 заместитель директора</div>
	  </div>
        <div class="col-md-4 col-6  mt-2 mb-2">	 
	 <img src="foto/IMG_2539_0.jpg" class="img-fluid" alt="">
	   <h5>Роман Агабеков</h5>	
	 <div class="text">Руководитель отдела DevOPS,<br > директор</div>
	  </div>
         <div class="col-md-4 col-6 mt-2 mb-2">	 
	 <img src="foto/IMG_2474_1.jpg" class="img-fluid" alt="">
	   <h5>Алексей Синица</h5>	
	 <div class="text">Руководитель отдела <br >поддержки сайтов</div>
	  </div>
         <div class="col-md-4 col-6 mt-2 mb-2 ">	 
	  <img src="foto/IMG_2522_0.jpg" class="img-fluid" alt="">
	   <h5>Дарья Бочкарёва</h5>	
	 <div class="text">Руководитель отдела <br >
		 продвижения, контекстной<br >
		 рекламы и контент-поддержки<br >
		 сайтов</div>
	  </div>
         <div class="col-md-4 col-6 mt-2 mb-2">	 
	  <img src="foto/IMG_9971_16.jpg" class="img-fluid" alt="">
	   <h5>Ирина Торкунова</h5>	
	 <div class="text">Менеджер по работе с <br >клиентами</div>
	  </div>
  </div>
	 	<a href="#team" class="py-3 btn btn-itd text-uppercase">Вся команда</a>
  </div>
<!-- сетка из фото  -->
		 <div class="container2">
          <div class="m-5">
            <h1 class="text-flex text-center pb-4">Последние кейсы</h1>
            <div class="fleximg">
              <ul>
                <li>
                  <img src="foto/pikch1.jpeg" alt="1" loading="lazy" />
                  <h4>
                    Настройка выгрузки YML для <br />
                    Яндекс. Маркета
                  </h4>
                  <p>
                    22.04.2019<br />
                    Эти слова совершенно справедливы, <br />однако гипнотический рифф продолжает <br />паузный пласт
                  </p>
                </li>
                <li style="width: 66%">
                  <div id="tekst_sverhu_kartinki">
                    <img src="foto/pikch2.png" alt="2" loading="lazy" />
                    <div class="tekst_sverhu_kartinki_1">
                      <h4>
                        Настройка выгрузки YML для <br />
                        Яндекс. Маркета
                      </h4>
                    </div>
                  </div>
                </li>
                <li>
                  <div id="tekst_sverhu_kartinki">
                    <img src="foto/pikch3.png" alt="3" loading="lazy" />
                    <div class="tekst_sverhu_kartinki_1">
                      <h4>
                        Настройка выгрузки YML для <br />
                        Яндекс. Маркета
                      </h4>
                      <span>22.04.2019</span>
                    </div>
                  </div>
                </li>
                <li>
                  <div id="tekst_sverhu_kartinki">
                    <img src="foto/pikch4.png" alt="4" loading="lazy" />
                    <div class="tekst_sverhu_kartinki_1">
                      <h4>
                        Настройка выгрузки YML для <br />
                        Яндекс. Маркета
                      </h4>

                      <span>22.04.2019</span>
                    </div>
                  </div>
                </li>
                <li>
                  <img src="foto/pikch8.png" alt="5" loading="lazy" />
                  <h4>
                    Настройка выгрузки YML для <br />
                    Яндекс. Маркета
                  </h4>
                  <p>
                    22.04.2019<br />
                    Эти слова совершенно справедливы, <br />однако гипнотический рифф продолжает <br />паузный пласт
                  </p>
                </li>

                <li style="width: 66%">
                  <div id="tekst_sverhu_kartinki">
                    <img src="foto/pikch6.png" alt="6" loading="lazy" />
                    <div class="tekst_sverhu_kartinki_1">
                      <h4>
                        Настройка выгрузки YML для <br />
                        Яндекс. Маркета
                      </h4>
                    </div>
                  </div>
                </li>
                <li>
                  <div id="tekst_sverhu_kartinki">
                    <img src="foto/pikch7.png" alt="7" loading="lazy" />
                    <div class="tekst_sverhu_kartinki_1">
                      <h4>
                        Настройка выгрузки YML для <br />
                        Яндекс. Маркета
                      </h4>
                      <span>22.04.2019</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <button class="butpic">Показать ещё</button>
          </div>
        </div>

	<!--Слайдер-->
        <div class="container3">
          <div class="text-slider">
            <div class="mt-5 d-flex justify-content-center">
              <div class="comanda-title m-5">
                <h2>Отзывы</h2>
              </div>
            </div>
            <div class="container">
              <div class="txts">
                <div class="row">
                  <div class="">
                    <div class="a" style="overflow: hidden; transition: 0.5s">
                      <div class="aa">
                        <div class="">
                          <img src="foto/logo_0.png" alt="">

                          <div class="pt-3 slidertext_text">Долгие поиски единственного и неповторимого мастера на многострадальный сайт www.cielparfum.com, который был собран крайне некомпетентным программистом и раз в месяц стабильно грозил погибнуть, привели меня на сайт и, в итоге, к ребятам из Drupal-coder. И вот уже практически полгода как не проходит и дня, чтобы я не поудивлялась и не порадовалась своему везению! Починили все, что не работало - от поиска до отображения меню. Провели редизайн - не отходя от желаемого, но со своими существенными и качественными дополнениями. Осуществили ряд проектов - конкурсы, тесты и тд. А уж мелких починок и доработок - не счесть! И главное - все качественно и быстро (не взирая на не самый "быстрый" тариф). Есть вопросы - замечательный Алексей всегда подскажет, поддержит, отремонтирует и/или просто сделает с нуля. Есть задумка для реализации - замечательный Сергей обсудит и предложит идеальный вариант. Есть проблема - замечательные Надежда и Роман починят, поправят, сделают! Ребята доказали, что эта CMS - мощная и грамотная система управления. Надеюсь, что наше сотрудничество затянется надолго! Спасибо!!!</div>
                        </div>

                        <div class="">
                          <img src="foto/logo.png" alt="">

                          <div class="pt-3 slidertext_text">Сергей — профессиональный, высококвалифицированный программист с огромным опытом в ИТ. Я долгое время общался с топ-фрилансерами (вся первая двадцатка) на веблансере и могу сказать, что С СЕРГЕЕМ ОНИ И РЯДОМ НЕ ВАЛЯЛИСЬ. Работаем с Сергеем до сих пор. С ним приятно работать, я доволен.</div>
                        </div>

                        <div class="">
                          <img src="foto/farbors_ru.jpg" alt="">

                          <div class="pt-3 slidertext_text">Выражаю глубочайшую благодарность команде специалистов компании "Инитлаб" и лично Дмитрию Купянскому и Алексею Синице. Сайт был первоклассно перевёрстан из старой табличной модели в новую на базе Drupal с дополнительной функциональностью. Всё было сделано с высочайшим качеством и точно в сроки. Всем кому хочется без нервов и лишних вопросов разработать сайт рекомендую обращаться именно к этой команде профессионалов.</div>
                        </div>

                        <div class="">
                          <img src="foto/nashagazeta_ch.png" alt="">

                          <div class="pt-3 slidertext_text">Моя электронная газета www.nashagazeta.ch существует в Швейцарии уже 10 лет. За это время мы сменили 7 специалистов по техподдержке, и только сейчас, в последние несколько месяцев, с начала сотрудничества с Алексеем Синицей и его командой, я впервые почувствовала, что у меня есть надежный технический тыл. Без громких слов и обещаний, ребята просто спокойно и качественно делают работу, быстро реагируют, находят решения, предлагают конкретные варианты улучшения функционирования сайта и сами их оперативно осуществляют. Сотрудничество с ними – одно удовольствие!</div>
                        </div>

                        <div class="">
                          <img src="foto/logo-estee.png" alt="">

                          <div class="pt-3 slidertext_text">Наша компания Estee Design занимается дизайном интерьеров. Сайт сверстан на Drupal. Искали программистов под выполнение ряда небольших изменений и корректировок по сайту. Пообщавшись с Алексеем Синицей, приняли решение о начале работ с компанией Initlab/drupal-coder. Сотрудничеством довольны на 100%. Четкая и понятная система коммуникации, достаточно оперативное решение по задачам. Дали рекомендации по улучшению програмной части сайта, исправили ряд скрытых ошибок. Никогда не пишу отзывы (нет времени), но в данном случае, по просьбе Алексея, не могу не рекомендовать Initlab другим людям - действительно компания профессионалов.</div>
                        </div>

                        <div class="">
                          <img src="foto/cableman_ru.png" alt="">

                          <div class="pt-3 slidertext_text">Наша компания за несколько лет сменила несколько команд программистов и специалистов техподдержки, и почти отчаялась найти на российском рынке адекватное профессиональное предложение по разумной цене. Пока мы не начали работать с командой "Инитлаб", воплощающей в себе все наши представления о нормальной системе взаимодействия в сочетании с профессиональным неравнодушием. Впервые в моей деловой практике я чувствую надежно прикрытыми важнейшие задачи в жизни электронного СМИ, при том, что мои коллеги работают за сотни километров от нас и мы никогда не встречались лично.</div>
                        </div>

                        <div class="">
                          <img src="foto/logo_2.png" alt="">

                          <div class="pt-3 slidertext_text">За довольно продолжительный срок (2014 - 2016 годы) весьма плотной работы (интернет-магазин на безумно замороченном Drupal 6: устраняли косяки разработчиков, ускоряли сайт, сделали множество новых функций и т.п.) - только самые добрые эмоции от работы с командой Initlab / Drupal-coder: всегда можно рассчитывать на быструю и толковую помощь, поддержку, совет. Даже сейчас, не смотря на то, что мы почти год не работали на постоянной основе (банально закончились задачи), случайно возникшая проблема с сайтом была решена мгновенно! В общем, только самые искренние благодарности и рекомендации! Спасибо! )</div>
                        </div>

                        <div class="">
                          <img src="foto/lpcma_rus_v4.jpg" alt="">

                          <div class="pt-3 slidertext_text">Хотел поблагодарить за работу над нашими сайтами.
			За 4 месяца работы привели сайт в порядок, а самое главное получили инструмент, с помощью мы теперь можем быстро и красиво выставлять контент для образования и работы с предприятиями
			http://lpcma.tsu.ru/ru/post/reference_material
			Ну и многому научись благодаря работе с вами. Мы очень рады, что удалось найти настолько компетентных ребят )
			</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pt-5 row">
                    <div class="">
                      <div class="button_slide">
                        <button class="b2 b11">
                          <img src="foto/arrow-left.svg" alt="arrow-left" >
                        </button>

                        <div class="ednum" style="font: 3em Montserrat">01</div>
                        <div style="font: 3em Montserrat">/</div>
                        <div style="font: 3em Montserrat">08</div>

                        <button class="b1 b22">
                          <img src="foto/arrow-right.svg" alt="arrow-right" >
                        </button>
		      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

       <!--Слайдер-->
<!--         <div class="mt-5 d-flex justify-content-center">
          <div class="slider-title mb-4">
            <h2>С нами работают</h2>

            <p>
              Десятки компаний доверяют нам самое ценное, что у них есть в интернете - свои <br >
              сайты. Мы доверяем всё, чтобы наше сотрудничество было долгим
            </p>
          </div>
        </div>
        <div class="mr-1">
          <div class="slider autoplay">
            <div class="mr-1">
              <img src="foto/Росатом.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/КУБГУ.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/газпром.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/ВТБ.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/Росатом.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/КУБГУ.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/газпром.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/ВТБ.png" alt="">
            </div>
          </div>
        </div>
	 </div>
        <div class="main" >
          <div class="slider autoplay2">
            <div class="mr-1">
              <img src="foto/ВТБ.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/Росатом.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/КУБГУ.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/газпром.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/ВТБ.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/Росатом.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/КУБГУ.png" alt="">
            </div>
            <div class="mr-1">
              <img src="foto/газпром.png" alt="">
            </div>
          </div>
        </div> -->
        
        <!-- 12 Пунктов -->
        <div>
          <section class="punkt12">
            <div class="container">
              <div class="row p-5">
                <div class="col-12">
                  <h2 class="text-center text-uppercase">FAQ</h2>
                </div>
              </div>
              <div class="row mb-5">
                <div class="red col-md-12 col-sm-12">
                  <h5 class="color_red text-left">1. Кто непосредственно занимается поддержкой?</h5>
                  <p>Сайты поддерживают штатные сотрудники ООО "Инитлаб", г. Краснодар, прошедшие специальное обучение и имеющие опыт работы с Друпал от 4 до 15 лет: 8 web-разработчиков, 2 специалиста по SEO, 4 системных администратора.</p>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">2. Как организована работа поддержки?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">3. Что происходит, когда отработаны все предоплаченные часы за месяц?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">4. Что происходит, когда не отработаны все предоплаченные часы за месяц?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">5. Как происходит оценка и согласование планируемого времени на выполнение заявок?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">6. Сколько программистов выделяется на проект?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">7. Как подать заявку на внесение изменений на сайте?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">8. Как подать заявку на добавление пользователя, изменение настроек веб-сервера и других задач по администрированию?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">9. В течение какого времени начинается работа по заявке?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">10. В какое время работает поддержка?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">11. Подходят ли услуги поддержки, если необходимо произвести обновление ядра Drupal или модулей?</h5>
                </div>
                <div class="col-md-12 col-sm-12">
                  <h5 class="text-left">12. Можно ли пообщаться со специалистом голосом или в мессенджере?</h5>
                </div>
              </div>
            </div>
          </section>
        </div>
<!--Footer-->

 <footer class="footer">
    <div class="container">

<form  method="post" class="form" id="ajaxForm">
	<div id="form-anchor"></div>
      <div class="head">
        <h2><b>Форма обратной связи</b></h2>

<div class="mess"><?php 
    if(isset($_SESSION['success_message'])) {
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']);
    } 
?></div>
<div class="mess mess_info"><?php 
    if(isset($_SESSION['info_message'])) {
        echo $_SESSION['info_message'];
        unset($_SESSION['info_message']);
    } 
?></div>
	    
      <div>
        <label> <input name="fio" class="input <?php echo ($errors['fio'] != NULL) ? 'red' : ''; ?>" value="<?php echo $values['fio']; ?>" type="text" placeholder="ФИО" /> </label>
        
          <div class="error" data-field="fio"><?php echo $messages['fio']?></div>

      </div>
      
      <div>
        <label> <input name="phone" class="input <?php echo ($errors['phone'] != NULL) ? 'red' : ''; ?>" value="<?php echo $values['phone']; ?>" type="tel" placeholder="Номер телефона" /> </label>
        <div class="error" data-field="phone"> <?php echo $messages['phone']?> </div>
      </div>
      
      <div>
        <label> <input name="email" class="input <?php echo ($errors['email'] != NULL) ? 'red' : ''; ?>" value="<?php echo $values['email']; ?>" type="text" placeholder="Почта" /> </label>
        <div class="error" data-field="email"> <?php echo $messages['email']?> </div>
      </div>
      
      <div>
        <label>
          <input name="birth_date" class="input <?php echo ($errors['birth_date'] != NULL) ? 'red' : ''; ?>" value="<?php if(strtotime($values['birth_date']) > 100000) echo $values['birth_date']; ?>" type="date" />
          <div class="error" data-field="birth_date"> <?php echo $messages['birth_date']?> </div>
        </label>
      </div>
      
      <div>
        <div>Пол</div>
        <div class="mb-1">
          <label>
            <input name="gender" class="ml-2" type="radio" value="M" <?php if($values['gender'] == 'M') echo 'checked'; ?>/>
            <span class="<?php echo ($errors['gender'] != NULL) ? 'error' : ''; ?>"> Мужской </span>
          </label>
          <label>
            <input name="gender" class="ml-2" type="radio" value="W" <?php if($values['gender'] == 'W') echo 'checked'; ?>/>
            <span class="<?php echo ($errors['gender'] != NULL) ? 'error' : ''; ?>"> Женский </span>
          </label>
        </div>
        <div class="error" data-field="gender"> <?php echo $messages['gender']?> </div>
      </div>
      
      <div>
        <div>Любимый язык программирования</div>
        <select class="my-2 <?php echo ($errors['language'] != NULL) ? 'red' : ''; ?>" name="language[]" multiple="multiple">
          <option value="Pascal" <?php echo (in_array('Pascal', $languages)) ? 'selected' : ''; ?>>Pascal</option>
          <option value="C" <?php echo (in_array('C', $languages)) ? 'selected' : ''; ?>>C</option>
          <option value="C++" <?php echo (in_array('C++', $languages)) ? 'selected' : ''; ?>>C++</option>
          <option value="JavaScript" <?php echo (in_array('JavaScript', $languages)) ? 'selected' : ''; ?>>JavaScript</option>
          <option value="PHP" <?php echo (in_array('PHP', $languages)) ? 'selected' : ''; ?>>PHP</option>
          <option value="Python" <?php echo (in_array('Python', $languages)) ? 'selected' : ''; ?>>Python</option>
          <option value="Java" <?php echo (in_array('Java', $languages)) ? 'selected' : ''; ?>>Java</option>
          <option value="Haskel" <?php echo (in_array('Haskel', $languages)) ? 'selected' : ''; ?>>Haskel</option>
          <option value="Clojure" <?php echo (in_array('Clojure', $languages)) ? 'selected' : ''; ?>>Clojure</option>
          <option value="Scala" <?php echo (in_array('Scala', $languages)) ? 'selected' : ''; ?>>Scala</option>
        </select>
        <div class="error" data-field="language[]"> <?php echo $messages['language']?> </div>
      </div>
      
      <div class="my-2">
        <div>Биография</div>
        <label>
          <textarea name="bio" class="input <?php echo ($errors['bio'] != NULL) ? 'red' : ''; ?>" placeholder="Биография"><?php echo $values['bio']; ?></textarea>
        </label>
      </div>
      
      <div>
        <label>
            <input name="agree" type="checkbox" <?php echo ($values['agree'] != NULL) ? 'checked' : ''; ?>/>
              С контрактом ознакомлен(а)
          <div class="error" data-field="check"> <?php echo $messages['agree']?> </div>
        </label>
      </div>
<div class="form-buttons">
    <button class="button submit-btn" type="submit" style="display: <?= $log ? 'none' : 'inline-block' ?>">Отправить</button>
    <a class="btnlike" href="login.php" style="display: <?= $log ? 'none' : 'inline-block' ?>">Войти</a>
    <button class="button edbut" type="submit" name="action" value="update" style="display: <?= $log ? 'inline-block' : 'none' ?>">Изменить</button>
    <button class="button logout-btn" type="button" id="logoutBtn" style="display: <?= $log ? 'inline-block' : 'none' ?>">Выйти</button>
</div>
	      
    </form>
	      
            <section id="block-copyright" class="block clear">
                <h6>&nbsp;</h6>
                <div class="fpt-56"><p>Проект ООО «Инитлаб», Краснодар, Россия. <br>
                    Drupal является зарегистрированной торговой маркой Dries Buytaert.</p></div>
            </section>


        </div>

    </div>
</footer>

</body>
</html> 





