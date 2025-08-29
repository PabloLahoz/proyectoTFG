import './bootstrap';
import Swal from 'sweetalert2'


window.Swal = Swal;

window.showSuccess = (message) => {
    Swal.fire({
        title: '¡Éxito!',
        text: message,
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
}

window.showError = (message) => {
    Swal.fire({
        title: 'Error',
        text: message,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
}

// Confirmación antes de eliminar, con entidad dinámica
window.confirmDelete = (formId, entityName = 'el registro') => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `Se eliminará ${entityName}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

window.confirmDeleteProduct = (formId, productName, quantity) => {
    if (quantity > 0) {
        Swal.fire({
            title: 'No se puede eliminar',
            text: `El producto "${productName}" tiene ${quantity} unidades en stock.`,
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        });
    } else {
        Swal.fire({
            title: '¿Estás seguro?',
            text: `¡Se eliminará el producto "${productName}" y no se podrá revertir!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
}
