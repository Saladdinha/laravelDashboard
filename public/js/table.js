$(document).ready(function () {
    //expand row
    $(".row .actions .rowMoreContent").on("click", function () {
        var row = $(this).closest('.row')
        if (row.hasClass("expand")) {
            row.removeClass("expand")
        } else {
            row.addClass("expand")
        }
    })
    //enable edit row
    $(".row .actions .rowEditContent").on("click", function () {
        var row = $(this).closest('.row')
        var inputs = row.find('input').not('input[type="checkbox"]')
        $.each(inputs, function (i, e) {
            $(this).attr('readonly', false)
        })
    });
    //export csv
    $(".row .actions .rowCsvExport").on("click", function () {
        var row = $(this).closest('.row')
        client = getClientValues(row)
        $.ajax({
            url: ajax.makeCsv,
            type: 'POST',
            data: {
                _token: ajax.token,
                client: client,
            },
            success: function (data) {
                var date = new Date()
                var current_date = date.getDate() + "-"
                    + (date.getMonth() + 1) + "-"
                    + date.getFullYear() + " "
                    + date.getHours() + ":"
                    + date.getMinutes() + ":"
                    + date.getSeconds();
                var fileName = `${client.name} ${current_date}.csv`
                var downloadLink = document.createElement("a");
                var fileData = ['\ufeff' + data];
                var blobObject = new Blob(fileData, {
                    type: "text/csv;charset=utf-8;"
                });
                var url = URL.createObjectURL(blobObject);
                downloadLink.href = url;
                downloadLink.download = fileName;

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        });
    })
    //update client BD
    $(".row .body .buttons .updateRow").on("click", function () {
        var row = $(this).closest('.row')
        client = getClientValues(row)
        $.ajax({
            url: ajax.updateClient,
            type: 'POST',
            data: {
                _token: ajax.token,
                client: client,
            },
            success: function (data) {
                $(".alert").slideDown(200)
                if (Object.getOwnPropertyNames(data) > 0) {
                    $(".alert").addClass("success")
                    $(".alert").text("Cliente atualizado com Sucesso")
                } else {
                    $(".alert").addClass("error")
                    $(".alert").text("Cliente Não Encontrado")
                }
                setTimeout(() => {
                    $(".alert").slideUp(200)
                }, 2000);
            }
        });
    })

    //bulk update client BD
    $(".bulk-actions .bulk-action.update").on("click", function () {
        var clients = []
        $.each($(".row-selector:checked").closest(".row"), function (i, e) {
            clients.push(getClientValues($(this)))
        })
        console.log(clients)
        if (clients.length > 0) {
            $.ajax({
                url: ajax.bulkUpdateClient,
                type: 'POST',
                data: {
                    _token: ajax.token,
                    clients: clients,
                },
                success: function (data) {
                    console.log(data)
                    $(".alert").slideDown(200)
                    if (data.length > 0) {
                        $(".alert").addClass("success")
                        $(".alert").text("Clientes atualizados com Sucesso")
                    } else {
                        $(".alert").addClass("error")
                        $(".alert").text("Clientes Não Encontrados")
                    }
                    setTimeout(() => {
                        $(".alert").slideUp(200)
                    }, 2000);
                }
            });
        } else {
            $(".alert").slideDown(200)
            $(".alert").addClass("warning")
            $(".alert").text("Nenhum Cliente Selecionado")
            setTimeout(() => {
                $(".alert").slideUp(200)
            }, 3000);
        }
    })

    // delete client BD
    $(".row .actions .rowDelete").on("click", function () {
        $(this).addClass("selected")
        $(".confirm-delete").slideDown(200)
    })

    //bulk delete client BD
    $(".bulk-actions .bulk-action.delete").on("click", function () {
        $(".confirm-delete").slideDown(200)
    })

    //delete confirm popup
    $(".confirm-delete .noDelete").on("click", function () {
        $(".confirm-delete").slideUp(200)
    })

    //delete bulk or single
    $(".confirm-delete .yesDelete").on("click", function () {
        $(".confirm-delete").slideUp(200)
        if ($(".row-selector:checked").length > 0) {
            var clients = []
            $.each($(".row-selector:checked").closest(".row"), function (i, e) {
                clients.push(getClientValues($(this)))
            })
            console.log(clients)
            $.ajax({
                url: ajax.bulkDeleteClient,
                type: 'POST',
                data: {
                    _token: ajax.token,
                    clients: clients,
                },
                success: function (data) {
                    $(".alert").slideDown(200)
                    if (data.length == 0) {
                        $(".alert").addClass("success")
                        $(".alert").text("Clientes Deletados com Sucesso")
                        $.each($(".row-selector:checked").closest(".row"), function (i, e) {
                            $(this).remove()
                        })
                    } else {
                        $(".alert").addClass("error")
                        $(".alert").text("Não Foi Possível Deletar os Clientes")
                    }
                    setTimeout(() => {
                        $(".alert").slideUp(200)
                    }, 3000);
                }
            });
        } else if ($(".row .actions .rowDelete.selected").length > 0) {
            var row = $(".row .actions .rowDelete.selected").closest('.row')
            client = getClientValues(row)
            console.log(client)
            $.ajax({
                url: ajax.deleteClient,
                type: 'POST',
                data: {
                    _token: ajax.token,
                    client: client,
                },
                success: function (data) {
                    $(".alert").slideDown(200)
                    if (data.length == 0) {
                        $(".alert").addClass("success")
                        $(".alert").text("Cliente Deletado com Sucesso")
                        row.remove()
                    } else {
                        $(".alert").addClass("error")
                        $(".alert").text("Não Foi Possível Deletar o Cliente")
                    }
                    setTimeout(() => {
                        $(".alert").slideUp(200)
                    }, 3000);
                }
            });
        } else {
            $(".alert").slideDown(200)
            $(".alert").addClass("warning")
            $(".alert").text("Nenhum Cliente Selecionado")
            setTimeout(() => {
                $(".alert").slideUp(200)
            }, 3000);
        }

    })
    //remove enrollment
    $(".removeEnrollment").on("click", function () {
        $(this).closest(".enrollment").remove()
    })
    // select all rows
    $("button.bulk-action.select").on("click", function () {
        $.each($(".table .row .row-selector"), function (i, e) {
            if (this.checked) {
                $(this).prop("checked", false)
            } else {
                $(this).prop("checked", true)
            }
        })
    })
    // export selected rows
    $("button.bulk-action.exportCsv").on("click", function () {
        var clients = []
        $.each($(".row-selector:checked").closest(".row"), function (i, e) {
            clients.push(getClientValues($(this)))
        })
        $.ajax({
            url: ajax.bulkMakeCsv,
            type: 'POST',
            data: {
                _token: ajax.token,
                clients: clients,
            },
            success: function (data) {
                var date = new Date()
                var current_date = date.getDate() + "-"
                    + (date.getMonth() + 1) + "-"
                    + date.getFullYear() + " "
                    + date.getHours() + ":"
                    + date.getMinutes() + ":"
                    + date.getSeconds();
                var fileName = `bulk export ${current_date}.csv`
                var downloadLink = document.createElement("a");
                var fileData = ['\ufeff' + data];
                var blobObject = new Blob(fileData, {
                    type: "text/csv;charset=utf-8;"
                });
                var url = URL.createObjectURL(blobObject);
                downloadLink.href = url;
                downloadLink.download = fileName;

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        });
    })
    function getClientValues(row) {
        var enrollments = []
        $.each(row.find('.enrollment'), function (i, e) {
            enrollment = {
                "id": $(this).find('.enrollment-id').val(),
                "group": $(this).find('.enrollment-group').val(),
                "modality": $(this).find('.enrollment-modality').val(),
                "division": $(this).find('.enrollment-division').val(),
                "gross_value": $(this).find('.enrollment-gross_value').val(),
                "discount_value": $(this).find('.enrollment-discount_value').val(),
                "net_value": $(this).find('.enrollment-net_value').val()
            }
            enrollments.push(enrollment)
        })
        var client = {
            "id": row.find(".client-id").val(),
            "name": row.find('input.client-name').val(),
            "document": row.find('.client-document').text().trim(),
            "value": row.find('input.client-value').val(),
            "stage_id": row.find('.client-stage_id').val(),
            "discount_value": row.find('.client-discount_value').val(),
            "net_value": row.find('.client-net_value').val(),
            "gross_value": row.find('.client-gross_value').val(),
            "credit_value": row.find('.client-credit_value').val(),
            "extra_value": row.find('.client-extra_value').val(),
            "enrollment_status": row.find('.client-enrollment_status').val(),
            "payments_type": row.find('.client-payments_type').val(),
            "payment_status": row.find('.client-payment_status').val(),
            "enrollments_qty": row.find('.client-enrollments_qty').val(),
            "enrollments": enrollments
        }
        return client
    }
})