import { handleFormLogin } from './loginForm.js';
import { handleFormRegister } from './registerForm.js';
export const sectionFormLoginRegister = () =>{

    const handleSection = () => {
        $('.login-container').addClass('loaded');
            
            // Efecto hover en el logo
            $('.logo-container img').hover(
                function() {
                    $(this).css('transform', 'scale(1.05)');
                },
                function() {
                    $(this).css('transform', 'scale(1)');
                }
            );

            $('#btn_change_form_to_register').click(function() {
                $(".login-container")
                    .addClass('reverse-layout')
                    .find('.logo-container, .form-container')
                    .css('transform', 'translateX(0)');
                
                $('#loginForm').fadeOut(300, function() {
                    $('#registerForm').fadeIn(300);
                });
            });

            $('#btn_change_form_to_login').click(function() {
                $(".login-container")
                    .removeClass('reverse-layout')
                    .find('.logo-container, .form-container')
                    .css('transform', 'translateX(0)');
                
                $('#registerForm').fadeOut(300, function() {
                    $('#loginForm').fadeIn(300);
                });
            });
    }

    handleSection();
    handleFormLogin();
    handleFormRegister();

}