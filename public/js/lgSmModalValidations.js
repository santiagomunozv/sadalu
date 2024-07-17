class LgSmModalValidations{
    static get idSmMsgsContainer(){return 'modal-sm-messages'};
    static get idLgMsgsContainer(){return 'modal-lg-messages'};
    static get idDynamicContainer(){return 'modal-dynamic-container'};
    static get idDynamicLgMsgsContainer(){return 'lg-dynamic-messages-container'};
    static get idBtnToggleContainer(){return 'btn-toggle-to-sm-container'};
    static showMessageSmall(messages , customMessage){
        LgSmModalValidations.updateLgErrors( messages );
        LgSmModalValidations.buildSmAlert(customMessage);
        document.getElementById(LgSmModalValidations.idBtnToggleContainer).onclick = function(){
            document.getElementById(LgSmModalValidations.idLgMsgsContainer).classList.add('d-none');
            document.getElementById(LgSmModalValidations.idDynamicContainer).classList.remove('d-none');
            document.getElementById(LgSmModalValidations.idSmMsgsContainer).classList.remove('d-none');
        };
    }

    static buildSmAlert(customMessage = 'Verifica los campos indicados'){
        let button = document.createElement('button');
        let icon = document.createElement('i');
        let span = document.createElement('span');
        let divBtn = document.createElement('div');
        let divTxt = document.createElement('div');
        let divRow = document.createElement('div');
        let divAlert = document.createElement('div');

        span.className = 'd-none d-lg-inline';
        span.innerText = ' Mas...';
        icon.className = 'fas fa-info-circle';

        button.className = 'btn btn-sm btn-secondary';
        button.onclick = function(){
            document.getElementById(LgSmModalValidations.idSmMsgsContainer).classList.add('d-none');
            document.getElementById(LgSmModalValidations.idDynamicContainer).classList.add('d-none');
            document.getElementById(LgSmModalValidations.idLgMsgsContainer).classList.remove('d-none');
        }

        button.appendChild(icon);
        button.appendChild(span);
        
        divBtn.className = 'col text-right';
        divBtn.appendChild(button);
        
        divTxt.innerText = customMessage ;
        divTxt.className = 'col';

        divRow.className = 'row';
        divRow.appendChild(divTxt);
        divRow.appendChild(divBtn);

        divAlert.className = 'alert alert-warning';
        divAlert.appendChild(divRow);

        document.getElementById(LgSmModalValidations.idSmMsgsContainer).appendChild(divAlert)
    }

    static updateLgErrors(messages){
        let ul = document.createElement('ul');
        messages.forEach(function( error ){
            let li= document.createElement('li');
            li.innerHTML = error;
            ul.appendChild( li );
        });
        let div = document.createElement('div');
        div.appendChild(ul);
        div.className = 'alert alert-warning';
        document.getElementById(LgSmModalValidations.idDynamicLgMsgsContainer).appendChild(div);
    }

    static clearErrors(){
        document.getElementById(LgSmModalValidations.idSmMsgsContainer).innerHTML = '';
        document.getElementById(LgSmModalValidations.idDynamicLgMsgsContainer).innerHTML = '';
    }
}