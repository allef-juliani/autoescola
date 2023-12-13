function validateForm() {
    // Expressão regular para validar e-mail
    var email = document.getElementById("email").value;
    var emailError = document.getElementById("emailError");
    var emailIsValid = true;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
        emailError.innerHTML = "Digite um e-mail válido.";
        emailIsValid = false;
    } else {
        emailError.innerHTML = "";
        //Expressão regular para validar senha
        var password = document.getElementById("senha").value;
        var passwordError = document.getElementById("passwordError");
        var passwordIsValid = true;

        if (password.length < 8 || !/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            passwordError.innerHTML = "A senha deve conter pelo menos 8 caracteres e incluir caracteres especiais.";
            passwordIsValid = false;
        } else {
            passwordError.innerHTML = "";
            //Expressão regular para validar nome
            var nome = document.getElementById("nome").value;
            var nomeError = document.getElementById("nomeError");
            var nomelsValid = true;

            if (nome.trim() === '') {
                nomeError.innerHTML = "Nome - Campo obrigatório";
                nomelsValid = false;
            } else {
                nomeError.innerHTML = "";
                //Expressão regular para validar cpf
                var cpf = document.getElementById("cpf").value;
                var cpfError = document.getElementById("cpfError");
                var cpflsValid = true;

                if (cpf.length < 14) {
                    cpfError.innerHTML = "CPF inválido";
                    cpflsValid = false;
                } else {
                    cpfError.innerHTML = "";
                    //Expressão regular para validar data
                    var data = document.getElementById("data").value;
                    var dataError = document.getElementById("dtError");
                    var datalsValid = true;

                    if (nome.trim() === '') {
                        dataError.innerHTML = "Data de Nascimento - Campo obrigatório";
                        datalsValid = false;
                    } else {
                        dataError.innerHTML = "";
                    }
                }
            }
        }
    }

    // Retorna true se ambos email e senha forem válidos, caso contrário, retorna false
    return emailIsValid && passwordIsValid && nomelsValid && cpflsValid && datalsValid;
}


// Máscara para CPF (formato: XXX.XXX.XXX-XX)
function maskCPF(elementId) {
    document.getElementById(elementId).addEventListener('input', function (e) {
        var target = e.target;
        var input = target.value.replace(/\D/g, '');
        var length = input.length;

        if (length > 11) {
            target.value = input.slice(0, 11);
            return;
        }

        if (length >= 4 && length <= 6) {
            target.value = input.slice(0, 3) + '.' + input.slice(3);
        } else if (length >= 7 && length <= 9) {
            target.value = input.slice(0, 3) + '.' + input.slice(3, 6) + '.' + input.slice(6);
        } else if (length >= 10) {
            target.value = input.slice(0, 3) + '.' + input.slice(3, 6) + '.' + input.slice(6, 9) + '-' + input.slice(9);
        }
    });
}

// MASCARA PARA NÚMERO TELEFONE FORMATO (00)00000-0000
function maskTelefone(input) {
    var digits = input.value.replace(/\D/g, '');
    var formatted = '';

    for (var i = 0; i < digits.length; i++) {
        if (i === 0) {
            formatted += '(' + digits[i];
        } else if (i === 1) {
            formatted += digits[i] + ')';
        } else if (i === 7) {
            formatted += '-' + digits[i];
        } else {
            formatted += digits[i];
        }
    }

    input.value = formatted;
}
