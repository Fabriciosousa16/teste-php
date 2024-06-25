$(document).ready(function () {

  // Validação Para Criar Novo Usuário
  function createUser() {

    var name = $('#name').val().trim();
    var email = $('#email').val().trim();

    if (name === '' || email === '') {
      Swal.fire({
        title: "Campos Obrigátorios",
        text: "Por favor, preencha todos os campos.",
        icon: "error"
      });
      return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
      Swal.fire({
        title: "Email Invalido",
        text: "Por favor, preencha um email válido.",
        icon: "error"
      });
      return false;
    }

    $.ajax({
      url: '/users/check-email',
      method: 'POST',
      data: { email: email },
      success: function (response) {
        if (response.exists) {
          Swal.fire({
            title: "Email já cadastrado",
            text: "O email informado já está em uso.",
            icon: "error"
          });
        } else {
          Swal.fire({
            title: "Sucesso",
            text: "Usuário Adicionado com sucesso.",
            icon: "success"
          }).then((result) => {
            if (result.isConfirmed) {
              $('#createUserForm').off('submit').submit();
            }
          });
        }
      }
    });

    return false;
  }

  $('#createUserForm').submit(function (e) {
    e.preventDefault();
    createUser();
  });

  // Validação Para Atualizar um Usuário

  function editUser(actionUrl) {
    var name = $('#name').val().trim();
    var email = $('#email').val().trim();
    var userId = actionUrl.split('/').pop();

    if (name === '' || email === '') {
      Swal.fire({
        title: "Os Campos São Obrigatórios!",
        text: "Por favor, preencha todos os campos.",
        icon: "error"
      });
      return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      Swal.fire({
        title: "Erro",
        text: "Por favor, insira um email válido.",
        icon: "error"
      });
      return false;
    }

    $.ajax({
      url: '/users/check-update-user/' + userId,
      method: 'POST',
      data: { email: email },
      success: function (response) {
        if (response.exists) {
          Swal.fire({
            title: "Email já cadastrado",
            text: "O email informado já está em uso.",
            icon: "error"
          });
        }
      }
    });

    Swal.fire({
      title: 'Tem certeza?',
      text: "Você deseja atualizar as informações do usuário?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, atualizar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $('#editUserForm').off('submit').submit();
      }
    });

    return false;
  }

  $('#editUserForm').submit(function (e) {
    e.preventDefault();
    var actionUrl = $(this).attr('action');
    editUser(actionUrl);
  });

  // Validação Para Deletar Usuário

  function confirmDeleteUser(userId) {

    $.ajax({
      url: '/users/check-delete-user/' + userId,
      method: 'POST',
      success: function (response) {
        if (response.exists) {
          Swal.fire({
            title: "Usuário Possui Cor Vinculada",
            text: "Não é possivel excluir um usuário com cor vinculada",
            icon: "error"
          });
        }
      }
    });

    Swal.fire({
      title: 'Tem certeza?',
      text: "Você não poderá desfazer esta ação!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sim, excluir!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '/users/delete/' + userId;
      }
    });
  }

  $('.delete-user').click(function (e) {
    e.preventDefault();
    var userId = $(this).data('id');
    confirmDeleteUser(userId);
  });

  // Validação Para Vincular Usuário a Uma Cor
  function linkUserColorById() {

    var colors = $('#colors').val();

    if (colors === null || colors.length === 0) {
      Swal.fire({
        title: "Erro",
        text: "Por favor, selecione pelo menos uma cor.",
        icon: "error"
      });
      return false;
    }

    Swal.fire({
      title: "Sucesso",
      text: "Cores vinculadas ao usuário com sucesso.",
      icon: "success"
    }).then((result) => {
      if (result.isConfirmed) {
        $('#linkUserColorByIdForm').off('submit').submit();
      }
    });

    return false;
  }

  $('#linkUserColorByIdForm').submit(function (e) {
    e.preventDefault();
    linkUserColorById();
  });

  // Validação Para Desvincular Usuário a Uma Cor

  function confirmDeleteUserColor(userId, colorId) {

    Swal.fire({
      title: 'Tem certeza?',
      text: "Você não poderá desfazer esta ação!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sim, excluir!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '/users-colors/destroy-colors/' + userId + '/' + colorId;
      }
    });
  }

  $('.delete-user-color').click(function (e) {
    e.preventDefault();
    var userId = $(this).data('user-id');
    var colorId = $(this).data('color-id');
    confirmDeleteUserColor(userId, colorId);
  });


  // Validação Para Criar Nova Cor
  function createColor() {

    var name = $('#name').val().trim();

    if (name === '') {
      Swal.fire({
        title: "Campo Obrigátorio",
        text: "Por favor, preencha o campo nome",
        icon: "error"
      });
      return false;
    }

    $.ajax({
      url: '/colors/check-color',
      method: 'POST',
      data: { name: name },
      success: function (response) {
        if (response.exists) {
          Swal.fire({
            title: "Cor já cadastrada",
            text: "A cor informada já está em uso.",
            icon: "error"
          });
        } else {
          Swal.fire({
            title: "Sucesso",
            text: "Cor Adicionado com sucesso.",
            icon: "success"
          }).then((result) => {
            if (result.isConfirmed) {
              $('#createColorForm').off('submit').submit();
            }
          });
        }
      }
    });
    return false;
  }

  $('#createColorForm').submit(function (e) {
    e.preventDefault();
    createColor();
  });

  // Validação para atualizar uma cor
  function editColor(actionUrl) {
    var name = $('#name').val().trim();
    var colorId = actionUrl.split('/').pop();

    if (name === '') {
      Swal.fire({
        title: "Campo Obrigátorio",
        text: "Por favor, preencha o campo nome",
        icon: "error"
      });
      return false;
    }

    $.ajax({
      url: '/colors/check-update-color/' + colorId,
      method: 'POST',
      data: { name: name },
      success: function (response) {
        if (response.exists) {
          Swal.fire({
            title: "Cor já cadastrada",
            text: "A cor informada já está em uso.",
            icon: "error"
          });
        }
      }
    });

    Swal.fire({
      title: 'Tem certeza?',
      text: "Você deseja atualizar o nome da Cor?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, atualizar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $('#editColorForm').off('submit').submit();
      }
    });

    return false;
  }

  $('#editColorForm').submit(function (e) {
    e.preventDefault();
    var actionUrl = $(this).attr('action');
    editColor(actionUrl);
  });

  // Validação Para Deletar Usuário
  function confirmDeleteColor(colorId) {

    $.ajax({
      url: '/colors/check-delete-color/' + colorId,
      method: 'POST',
      success: function (response) {
        if (response.exists) {
          Swal.fire({
            title: "Cor Possui Usuário Vinculada",
            text: "Não é possivel excluir uma cor com usuário vinculada",
            icon: "error"
          });
        }
      }
    });

    Swal.fire({
      title: 'Tem certeza?',
      text: "Você não poderá desfazer esta ação!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sim, excluir!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '/colors/delete/' + colorId;
      }
    });
  }

  $('.delete-color').click(function (e) {
    e.preventDefault();
    var colorId = $(this).data('id');
    confirmDeleteColor(colorId);
  });

  // Validação Para Vincular Usuário a Uma Cor sem Pegar o ID
  function linkUserColor() {
    var colors = $('#colors').val();
    var users = $('#users').val();

    if (colors === null || colors.length === 0 || users === null || users.length === 0) {
      Swal.fire({
        title: "Erro",
        text: "Todo os Campos São Obrigatórios.",
        icon: "error"
      });
      return false;
    }

    Swal.fire({
      title: "Sucesso",
      text: "Cores vinculadas ao usuário com sucesso.",
      icon: "success"
    }).then((result) => {
      if (result.isConfirmed) {
        $('#linkUserColorForm').off('submit').submit();
      }
    });

    return false;
  }

  $('#linkUserColorForm').submit(function (e) {
    e.preventDefault();
    linkUserColor();
  });

});
