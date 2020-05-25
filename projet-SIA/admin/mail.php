<div class="container">
    <div class="row inbox">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div id="mail" class="panel-body inbox-menu">
                    <a href="#page-inbox-compose.html" class="btn btn-danger btn-block">Nouveau message</a>
                    <ul>
                        <li>
                            <a href="#page-inbox.html"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger">4</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-star"></i>Favori</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-rocket"></i> Envoyé</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-trash-o"></i> Poubelle</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bookmark"></i> Important<span class="label label-info">5</span></a>
                        </li>
                        <li class="title">
                            Thèmes
                        </li>
                        <li>
                            <a href="#" style="border:solid yellow">Lettre d'information <span class="label label-success"></span></a>
                        </li>
                        <li>
                            <a href="#">Accueil des étudiants en France <span class="label label-danger"></span></a>
                        </li>
                        <li>
                            <a href="#">Action sociale et solidarité <span class="label label-info"></span></a>
                        </li>
                        <li>
                            <a href="#">Education<span class="label label-success"></span></a>
                        </li>
                        <li>
                            <a href="#">Santé et mutuelle<span class="label label-success"></span></a>
                        </li>


                    </ul>
                </div>
            </div>

        </div>
        <!--/.col-->

        <div class="col-md-9">
            <div class="panel panel-default">
                <div id="mail" class="panel-body message">
                    <p class="text-center" style="border:solid green">Nouveau message</p>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="to" class="col-sm-1 control-label">A:</label>
                            <div class="col-sm-11">
                                <input type="email" class="form-control select2-offscreen" id="to" placeholder="Type email" tabindex="-1" value="groupes-abonnes-membresbureau-forum;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bcc" class="col-sm-1 control-label">Objet:</label>
                            <div class="col-sm-11">
                                <input type="text" class="form-control select2-offscreen" id="bcc" placeholder="Objet" tabindex="-1" value="Lettre d'information">
                            </div>
                        </div>

                    </form>

                    <div class="col-sm-11 col-sm-offset-1">

                        <div class="btn-toolbar" role="toolbar">

                            <div class="btn-group">
                                <button class="btn btn-default"><span class="fa fa-bold"></span></button>
                                <button class="btn btn-default"><span class="fa fa-italic"></span></button>
                                <button class="btn btn-default"><span class="fa fa-underline"></span></button>
                            </div>

                            <div class="btn-group">
                                <button class="btn btn-default"><span class="fa fa-align-left"></span></button>
                                <button class="btn btn-default"><span class="fa fa-align-right"></span></button>
                                <button class="btn btn-default"><span class="fa fa-align-center"></span></button>
                                <button class="btn btn-default"><span class="fa fa-align-justify"></span></button>
                            </div>

                            <div class="btn-group">
                                <button class="btn btn-default"><span class="fa fa-indent"></span></button>
                                <button class="btn btn-default"><span class="fa fa-outdent"></span></button>
                            </div>

                            <div class="btn-group">
                                <button class="btn btn-default"><span class="fa fa-list-ul"></span></button>
                                <button class="btn btn-default"><span class="fa fa-list-ol"></span></button>
                            </div>
                            <button class="btn btn-default"><span class="fa fa-trash-o"></span></button>
                            <button class="btn btn-default"><span class="fa fa-paperclip"></span></button>

                        </div>
                        <br>

                        <div class="form-group">
                            <textarea class="form-control" id="message" name="body" rows="25" placeholder="Click here to reply">Madames, Monsieurs,
 L'ambition d'EPA pour l'année à venir :Évoluer c'est avancer vers d'autres possibles ou oser affronter d'autres réalités !

Pour ce faire, notre association a besoin, à moyen terme, d'un  état des lieux de besoins récurrents dans tous les domaines relevant du champ de l'ESS.

Si possible, mesurer par exemple, l'impact de la demande d'accès aux soins de qualité en  général, et plus particulièrement pour les personnes économiquement faibles.

Promouvoir une couverture Santé par un système d'entraide santé, pour ne pas parler de complémentaire santé est notre objectif à long terme.

Celui-ci n'est envisageable que s'il y a plus de réactivité autour des initiatives d'intérêt général ciblées qui se font jour çà et là en Afrique.

Le portail doit permettre aux dirigeants d'EPA de repérer ou de susciter des synergies de formes de solidarité organisées pour résoudre économiquement les besoins des populations.

Le projet "Santé pour tous - pour une mutuelle solidaire en Afrique" est notre ambition pour les dix ans à venir.

Ce projet  n'est envisageable que s'il est relayé par l'ensemble des acteurs majeurs de l'´ESS au Nord et au Sud.

Par la Présidente
                        </textarea>
                        </div>

                        <div class="form-group" style="text-align:center">
                            <button type="submit" class="btn btn-success">Envoyé</button>
                            <button type="submit" class="btn btn-warning">Sauvegarder</button>
                            <button type="submit" class="btn btn-danger">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
</div>

<style>
    #mail {
        margin-top: 20px;
        background: white;
    }


    .inbox .inbox-menu ul {
        margin-top: 30px;
        padding: 0;
        list-style: none
    }

    .inbox .inbox-menu ul li {
        height: 30px;
        padding: 5px 15px;
        position: relative
    }

    .inbox .inbox-menu ul li:hover,
    .inbox .inbox-menu ul li.active {
        background: #e4e5e6
    }

    .inbox .inbox-menu ul li.title {
        margin: 20px 0 -5px 0;
        text-transform: uppercase;
        font-size: 10px;
        color: #d1d4d7
    }



    .inbox .inbox-menu ul li a {
        display: block;
        width: 100%;
        text-decoration: none;
        color: #3d3f42
    }

    .inbox .inbox-menu ul li a i {
        margin-right: 10px
    }

    .inbox .inbox-menu ul li a .label {
        position: absolute;
        top: 10px;
        right: 15px;
        display: block;
        min-width: 14px;
        height: 14px;
        padding: 2px
    }

    .inbox ul.messages-list {
        list-style: none;
        margin: 15px -15px 0 -15px;
        padding: 15px 15px 0 15px;
        border-top: 1px solid #d1d4d7
    }

    .inbox ul.messages-list li {
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        cursor: pointer;
        margin-bottom: 10px;
        padding: 10px
    }

    .inbox ul.messages-list li a {
        color: #3d3f42
    }

    .inbox ul.messages-list li a:hover {
        text-decoration: none
    }

    .inbox ul.messages-list li.unread .header,
    .inbox ul.messages-list li.unread .title {
        font-weight: 700
    }

    .inbox ul.messages-list li:hover {
        background: #e4e5e6;
        border: 1px solid #d1d4d7;
        padding: 9px
    }

    .inbox ul.messages-list li:hover .action {
        color: #d1d4d7
    }

    .inbox ul.messages-list li .header {
        margin: 0 0 5px 0
    }

    .inbox ul.messages-list li .header .from {
        width: 49.9%;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis
    }

    .inbox ul.messages-list li .header .date {
        width: 50%;
        text-align: right;
        float: right
    }

    .inbox ul.messages-list li .title {
        margin: 0 0 5px 0;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis
    }

    .inbox ul.messages-list li .description {
        font-size: 12px;
        padding-left: 29px
    }

    .inbox ul.messages-list li .action {
        display: inline-block;
        width: 16px;
        text-align: center;
        margin-right: 10px;
        color: #d1d4d7
    }

    .inbox ul.messages-list li .action .fa-check-square-o {
        margin: 0 -1px 0 1px
    }

    .inbox ul.messages-list li .action .fa-square {
        float: left;
        margin-top: -16px;
        margin-left: 4px;
        font-size: 11px;
        color: #fff
    }

    .inbox ul.messages-list li .action .fa-star.bg {
        float: left;
        margin-top: -16px;
        margin-left: 3px;
        font-size: 12px;
        color: #fff
    }

    .inbox .message .message-title {
        margin-top: 30px;
        padding-top: 10px;
        font-weight: 700;
        font-size: 14px
    }

    .inbox .message .header {
        margin: 20px 0 30px 0;
        padding: 10px 0 10px 0;
        border-top: 1px solid #d1d4d7;
        border-bottom: 1px solid #d1d4d7
    }

    .inbox .message .header .avatar {
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        height: 34px;
        width: 34px;
        float: left;
        margin-right: 10px
    }

    .inbox .message .header i {
        margin-top: 1px
    }

    .inbox .message .header .from {
        display: inline-block;
        width: 50%;
        font-size: 12px;
        margin-top: -2px;
        color: #d1d4d7
    }

    .inbox .message .header .from span {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #3d3f42
    }

    .inbox .message .header .date {
        display: inline-block;
        width: 29%;
        text-align: right;
        font-size: 12px;
        margin-top: 18px
    }

    .inbox .message .attachments {
        border-top: 3px solid #e4e5e6;
        border-bottom: 3px solid #e4e5e6;
        padding: 10px 0;
        margin-bottom: 20px;
        font-size: 12px
    }

    .inbox .message .attachments ul {
        list-style: none;
        margin: 0 0 0 -40px
    }

    .inbox .message .attachments ul li {
        margin: 10px 0
    }

    .inbox .message .attachments ul li .label {
        padding: 2px 4px
    }

    .inbox .message .attachments ul li span.quickMenu {
        float: right;
        text-align: right
    }

    .inbox .message .attachments ul li span.quickMenu .fa {
        padding: 5px 0 5px 25px;
        font-size: 14px;
        margin: -2px 0 0 5px;

    }
</style>