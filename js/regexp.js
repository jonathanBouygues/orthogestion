/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Creation of RegExp █▄██▄█

class CheckRegExp {
    constructor() {
        // Initialisations
        this.regTel = "^([0-9]{2})(-[0-9]{2}){4}$";
        this.regMail = "^[-0-9a-zA-Z.+]+@[-0-9a-zA-Z.+]+.[a-zA-Z]{2,4}$";
        this.regTxtStNn = "^[0-9a-zA-Zéèëàäöôïîûüñõ',. ]{2,30}$";
        this.regTxtStNu = "^[0-9a-zA-Zéèëàäöôïîûüñõ',. ]{0,30}$";
        this.regTxtLgNn = "^[0-9a-zA-Zéèëàäöôïîûüñõ.,'!?% ]{2,255}$";
        this.regTxtLgNu = "^[0-9a-zA-Zéèëàäöôïîûüñõ.,'!?% ]{0,255}$";
        this.regIntSt = "^[0-9]{1,2}$";
        this.regSS = "^([0-9]{1})(([ ]([0-9]{2})){3})(([ ]([0-9]{3})){2})([ ]([0-9]{2}))$";
        this.regDec = "^[-]?[0-9]{1,4}([.][0-9]{1,2})?$";
    }

    // Check the Tel in a method
    verifTel(data) {
        // Initialisation object "RegExp"
        let temp = new RegExp(this.regTel);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check the Mail in a method
    verifMail(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regMail);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check short text (non NULL)in a method
    verifTxtStNn(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regTxtStNn);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check short text (maybe NULL) in a method
    verifTxtStNu(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regTxtStNu);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check long text in a method
    verifTxtLgNn(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regTxtLgNn);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check long text in a method
    verifTxtLgNu(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regTxtLgNu);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check age in a method
    verifAge(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regIntSt);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check age in a method
    verifNumSS(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regSS);
        // Check
        return tempRegExp.test(data.value);
    }
    // Check decimal in a method
    verifDec(data) {
        // Initialisation object "RegExp"
        let tempRegExp = new RegExp(this.regDec);
        // Check
        return tempRegExp.test(data.value);
    }

}

// Instanciation of the object
let regExp = new CheckRegExp();