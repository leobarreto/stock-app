$(() => {
    $('#price').maskMoney({
        prefix: 'R$',
        thousands: '.',
        decimal: ','
    });
});
