<div class="container">
    <div class="row">
        <div class="col-12 section-title presentation-title">
            <h1><span class="section-title-icon"><i class="fa fa-envelope fa-x3" aria-hidden="true"></i></span>Me contacter</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div style="display:none" class="alert alert-success">
                        <span>Votre message a bien été envoyé</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
            </div>
            <form id="form-contact" action="{{ route('ContactStore')}}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control email" name="email">
                </div>
                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" class="form-control lastname" name="lastname">
                </div>

                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control firstname" name="firstname">
                </div>

                <div class="form-group">
                    <label for="content">Message*</label>
                    <textarea class="form-control form-message content" name="content" id="content" rows="8"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-dark">
                </div>
            </form>
        </div>
    </div>
</div>
