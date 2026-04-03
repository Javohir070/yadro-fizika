
// Tahrirlash tugmasini bosganda modalni ochish va ma'lumotlarni to'ldirish
function openShowModal(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/bookaroom/${id}`,
        type: 'GET',
        success: function (data) {
            // Ma'lumotlarni modal shaklida aks ettiramiz
            $('#room').text(data.room); // Sana qiymati
            $('#bolimi').text(data.bolimi); // Sana qiymati
            $('#user').text(data.user); // Sana qiymati
            $('#event_name').text(data.event_name); // Sana qiymati
            $('#start_date').text(data.start_date); // Sana qiymati
            $('#end_date').text(data.end_date); // Sana qiymati
            $('#event_purpose').text(data.event_purpose); // Sana qiymati
            $('#comment').text(data.comment); // Sana qiymati
            $('#date').text(data.date); // Sana qiymati
            $('#science-sub-category').val(data.type);
            $('#status').text(data.status); // Sana qiymati

            const statusButton = $('#status');
            switch (data.status) {
                case 'new':
                    statusButton.text('Yangi').removeClass().addClass('btn btn-success text-white');
                    break;
                case 'approved':
                    statusButton.text('Tasdiqlandi').removeClass().addClass('btn btn-info text-white');
                    break;
                case 'rejected':
                    statusButton.text('Rad etildi').removeClass().addClass('btn btn-danger text-white');
                    break;
                default:
                    statusButton.text('Tugagan').removeClass().addClass('btn btn-primary text-white');
                    break;
            }

            // Formaning action URL manzilini yangilash
            $('#science-paper-edit-form').attr('action', `/reasondelayedit/${id}/edit`);
            $('#ratetish_button').attr('onclick', `openRadetishModal(${id})`);
            $('#qabulqilish_button').attr('onclick', `openQabulqilishModal(${id})`);
            // Modalni ko'rsatish
            $('#science-paper-show-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openShowModalRoomapi(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `https://idora.ilmiy.uz/api/get/bookaroom/show/${id}`,
        type: 'GET',
        success: function (data) {
            // Ma'lumotlarni modal shaklida aks ettiramiz
            $('#room').text(data.room); // Sana qiymati
            $('#bolimi').text(data.bolimi); // Sana qiymati
            $('#user').text(data.user); // Sana qiymati
            $('#event_name').text(data.event_name); // Sana qiymati
            $('#start_date').text(data.start_date); // Sana qiymati
            $('#end_date').text(data.end_date); // Sana qiymati
            $('#event_purpose').text(data.event_purpose); // Sana qiymati
            $('#comment').text(data.comment); // Sana qiymati
            $('#date').text(data.date); // Sana qiymati
            $('#science-sub-category').val(data.type);
            $('#status').text(data.status); // Sana qiymati

            const statusButton = $('#status');
            switch (data.status) {
                case 'new':
                    statusButton.text('Yangi').removeClass().addClass('btn btn-success text-white');
                    break;
                case 'approved':
                    statusButton.text('Tasdiqlandi').removeClass().addClass('btn btn-info text-white');
                    break;
                case 'rejected':
                    statusButton.text('Rad etildi').removeClass().addClass('btn btn-danger text-white');
                    break;
                default:
                    statusButton.text('Tugagan').removeClass().addClass('btn btn-primary text-white');
                    break;
            }

            // Formaning action URL manzilini yangilash
            $('#science-paper-edit-form').attr('action', `/reasondelayedit/${id}/edit`);
            $('#ratetish_button').attr('onclick', `openRadetishModal(${id})`);
            $('#qabulqilish_button').attr('onclick', `openQabulqilishModal(${id})`);
            // Modalni ko'rsatish
            $('#science-paper-show-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

//xona band qilish uchun edit modal

function openEditModal(id) {
    $.ajax({
        url: `/bookaroom/${id}`,
        type: 'GET',
        success: function (data) {
            $('#event_name_edit').val(data.event_name); // Sana qiymati
            $('#start_date').val(data.start_date); // Sana qiymati
            $('#end_date').val(data.end_date); // Sana qiymati
            $('#event_purpose_edit').val(data.event_purpose); // Sana qiymati

            $('#science-paper-edit-form').attr('action', `/bookaroomedit/${id}/edit`);


            // Modalni ko'rsatish
            $('#science-paper-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openEditModalRoomapi(id) {
    $.ajax({
        url: `https://idora.ilmiy.uz/api/get/bookaroom/show/${id}`,
        type: 'GET',
        success: function (data) {
            $('#event_name_edit').val(data.event_name); // Sana qiymati
            $('#start_date').val(data.start_date); // Sana qiymati
            $('#end_date').val(data.end_date); // Sana qiymati
            $('#event_purpose_edit').val(data.event_purpose); // Sana qiymati

            $('#science-paper-edit-form').attr('action', `/room/${id}`);


            // Modalni ko'rsatish
            $('#science-paper-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openRadetishModal(id) {
    $.ajax({
        url: `/bookaroom/${id}`,
        type: 'GET',
        success: function (data) {
            $('#comment_edit').val(data.comment_edit); // Sana qiymati

            $('#science-paper-radetish-form').attr('action', `/bookaroomradetish/${id}/edit`);

            $('#science-paper-radetish-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openQabulqilishModal(id) {
    $.ajax({
        url: `/bookaroom/${id}`,
        type: 'GET',
        success: function (data) {
            $('#comment_edit').val(data.comment_edit); // Sana qiymati

            $('#science-paper-qabulqilish-form').attr('action', `/bookaroomqabulqilish/${id}/edit`);

            $('#science-paper-qabulqilish-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}



function openRahbarqabulgaModal(id) {
    $.ajax({
        url: `/censusresult/${id}`,
        type: 'GET',
        success: function (data) {
            $('#start_edit_edit').val(data.start_date_show); // Sana qiymati
            $('#end_date_edit').val(data.end_date_show); // Tugash qiymati

            $('#science-paper-rahbarqabulga-form').attr('action', `/censusresultqabulqilish/${id}/edit`);

            $('#science-paper-rahbarqabulga-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openEditBandqilishModal(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/censusresult/${id}`,
        type: 'GET',
        success: function (data) {
            // Ma'lumotlarni modal shaklida aks ettiramiz
            $('#day_edit').val(data.start_date_edit); // Sana qiymati

            $('#name').val(data.name); // Sabab qiymaticomment
            $('#comment').val(data.comment); // Sabab qiymaticomment
            $('#science-sub-category').val(data.type);
            // Formaning action URL manzilini yangilash
            $('#science-paper-edit-form').attr('action', `/censusresultedit/${id}/edit`);

            // Modalni ko'rsatish
            $('#science-paper-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openQabulgaShowModal(id) {
    $.ajax({
        url: `/censusresult/${id}`,
        type: 'GET',
        success: function (data) {
            // Ma'lumotlarni modal shaklida aks ettiramiz
            $('#kimningqabulga').text(data.kimningqabulga); // Sana qiymati
            $('#bulim').text(data.bulim); // Sana qiymati
            $('#user').text(data.user); // Sana qiymati
            $('#day_date').text(data.day); // Sana qiymati
            $('#nomi').text(data.name); // Sabab qiymaticomment
            $('#comment_ment').text(data.comment); // Sabab qiymaticomment
            $('#answer').text(data.answer); // Sana qiymati
            $('#status_tus').text(data.status); // Sana qiymati
            const statusButton = $('#status_tus');
            switch (data.status) {
                case 'new':
                    statusButton.text('Yangi').removeClass().addClass('btn btn-subtle-warning');
                    break;
                case 'exited':
                    statusButton.text('Yakunlangan').removeClass().addClass('btn btn-subtle-secondary ');
                    break;
                case 'queue':
                    statusButton.text('Navbatda').removeClass().addClass('btn btn-subtle-info ');
                    break;
                case 'rejected':
                    statusButton.text('Rad etildi').removeClass().addClass('btn btn-subtle-danger ');
                    break;
                default:
                    statusButton.text('Qabulda').removeClass().addClass('btn btn-subtle-success ');
                    break;
            }

            // Formaning action URL manzilini yangilash
            // $('#science-paper-edit-form').attr('action', `/reasondelayedit/${id}/edit`);
            $('#rahbarqabulgaRatetish_button').attr('onclick', `openRahbarRadetishModal(${id})`);
            $('#rahbarqabulga_button').attr('onclick', `openRahbarqabulgaModal(${id})`);
            // Modalni ko'rsatish
            $('#science-qabulga-yozilash-show-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openRahbarRadetishModal(id) {
    $.ajax({
        url: `/censusresult/${id}`,
        type: 'GET',
        success: function (data) {
            $('#day_edit').val(data.star_date); // Sana qiymati

            $('#science-rahbar-qabulga-form').attr('action', `/censusresultradetish/${id}/edit`);

            $('#science-rahbar-ratetish-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}


function openRahbarTopshiriqModal(id) {
    $.ajax({
        url: `/censusresult/${id}`,
        type: 'GET',
        success: function (data) {
            $('#name_topshiriq_edit').text(data.name); // Sana qiymati
            $('#day_edit').text(data.day); // Sana qiymati

            $('#science-rahbar-topshiriq-form').attr('action', `/censusresulttopshiriq/${id}/edit`);

            $('#science-rahbar-topshiriq-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}



// ish  reja

function openChoraTadbirModal(id) {
    $.ajax({
        url: `/measures/${id}`,
        type: 'GET',
        success: function (data) {
            $('#name_edit').val(data.name); // Sana qiymati

            $('#science-chora-edit-form').attr('action', `/measur/${id}/edit`);

            $('#science-chora-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openAmalgaOshirishModal(id) {
    $.ajax({
        url: `/workplan/${id}`,
        type: 'GET',
        success: function (data) {
            $('#name_edit_amalga').val(data.name); // Sana qiymati
            $('#term_edit').val(data.term); // Sana qiymati

            $('#science-mexanizmini-edit-form').attr('action', `/workplans/${id}/edit`);

            $('#science-mexanizmini-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}


function openAKTgaMurojaatEditModal(id) {
    $.ajax({
        url: `/appeal/${id}`,
        type: 'GET',
        success: function (data) {
            $('#name_edit_murojaat').val(data.name);

            $('#science-AKTga-murojaat-form').attr('action', `/appealedit/${id}/edit`);

            $('#science-AKTgamurojjat-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openAKTgaMurojaatCheckModal(id) {
    $.ajax({
        url: `/appeal/${id}`,
        type: 'GET',
        success: function (data) {
            $('#science-paper-check-form').attr('action', `/appealcheck/${id}/check`);

            $('#science-paper-check-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}


function openAmalgaOshirihsModal(id) {
    $.ajax({
        url: `/measures/${id}`,
        type: 'GET',
        success: function (data) {
            $('#measures_id').val(data.ID);

            $('#science-mexanizmini-create-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openAmalgaOshirishRadetishModal(id) {
    $.ajax({
        url: `/workplan/${id}`,
        type: 'GET',
        success: function (data) {
            $('#comment_edit').val(data.comment); // Sana qiymati

            $('#science-chora-radetish-form').attr('action', `/workplans/${id}/edit`);

            $('#science-chora-radetish-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}


//ishdan ruqsad olish model edit

function openEditModalIshdan(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/reasondelay/${id}`,
        type: 'GET',
        success: function (data) {
            // Ma'lumotlarni modal shaklida aks ettiramiz
            $('#date').val(data.dt); // Sana qiymati
            $('#sabab').val(data.note); // Sabab qiymati
            $('#science-sub-category').val(data.type);
            // Formaning action URL manzilini yangilash
            $('#science-paper-edit-form').attr('action', `/reasondelayedit/${id}/edit`);

            // Modalni ko'rsatish
            $('#science-paper-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}


function openEditGiveinformationModal(id) {
    $.ajax({
        url: `/giveinformation/${id}`,
        type: 'GET',
        success: function (data) {
            $('#information_edit').val(data.information); // Sana qiymati

            $('#giveinformation-paper-edit-form').attr('action', `/giveinformationedit/${id}/edit`);


            // Modalni ko'rsatish
            $('#science-paper-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}


function openEditModalMehnattatili(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/vacation/${id}`,
        type: 'GET',
        success: function (data) {
            $('#start_date_edit').val(data.start_date);
            $('#end_date_edit').val(data.end_date);
            $('#comment_edit').val(data.comment);
            $('#type_edit').val(data.type);
            $('#mehnat-tatili-edit-form').attr('action', `/vacation/${id}/edit`);
            $('#mehnat-tatili-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openEditAcceptanceModal(id) {
    $.ajax({
        url: `/acceptance/${id}`,
        type: 'GET',
        success: function (data) {
            let imageUrl = '/storage/' + data.image;
            let photoUrl = '/storage/' + data.photo;
            $('#previewPhoto').attr('src', photoUrl);
            $('#previewImage').attr('src', imageUrl);
            $('#full_name').text(data.full_name);

            $('#acceptance-paper-edit-form').attr('action', `/acceptanceedit/${id}/edit`);
            $('#acceptance-paper-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openEditAcceptanceRadModal(id) {
    $.ajax({
        url: `/acceptance/${id}`,
        type: 'GET',
        success: function (data) {
            $('#full_name_rad').text(data.full_name);
            let imageUrl = '/storage/' + data.image;
            let photoUrl = '/storage/' + data.photo;
            $('#previewPhoto_rad').attr('src', photoUrl);
            $('#previewImage_rad').attr('src', imageUrl);

            $('#acceptance-paper-rad-form').attr('action', `/acceptanceedit/${id}/edit`);
            $('#acceptance-paper-rad-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openViewFileModal(id) {
    $.ajax({
        url: `/files/${id}`,
        type: 'GET',
        success: function (data) {
            let fileUrl = '/storage/' + data.path;
            $('#previewfile').attr('src', fileUrl);

            // $('#view-file').attr('src', `/acceptanceedit/${id}/edit`);
            $('#acceptance-view-file-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openViewFileTaskModal(id) {
    $.ajax({
        url: `/taskfile/${id}`,
        type: 'GET',
        success: function (data) {
            let fileUrl = '/storage/' + data.file_path;
            $('#previewfile').attr('src', fileUrl);

            // $('#view-file').attr('src', `/acceptanceedit/${id}/edit`);
            $('#acceptance-view-file-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openViewFileModalMehnattatili(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/vacation/${id}`,
        type: 'GET',
        success: function (data) {
            let fileUrl = '/storage/' + data.file;
            $('#previewfile').attr('src', fileUrl);

            $('#acceptance-view-file-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openViewFileLetterofExplanation(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/letterofexplanations/${id}`,
        type: 'GET',
        success: function (data) {
            let fileUrl = '/storage/' + data.file;
            $('#previewfile').attr('src', fileUrl);

            $('#acceptance-view-file-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openEditModalLetterofExplanation(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/letterofexplanations/${id}`,
        type: 'GET',
        success: function (data) {
            $('#letterofexplanation_comment_edit').val(data.comment);
            $('#tushunish-xati-update-form').attr('action', `/letterofexplanations/${id}`);
            $('#tushunish-xati-update-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });

}

function openViewFileModalGiveinformationd(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/giveinformation/${id}`,
        type: 'GET',
        success: function (data) {
            let fileUrl = '/storage/' + data.file;
            $('#previewfile').attr('src', fileUrl);

            $('#acceptance-view-file-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openEditAgencykpiKpiModal(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/agencykpi/${id}`,
        type: 'GET',
        success: function (data) {
            // Ma'lumotlarni modal shaklida aks ettiramiz
            $('#task_name').val(data.task_name); // Sana qiymati
            $('#ball_edit').val(data.ball); // Sabab qiymaticomment
            $('#indicator_amount').val(data.indicator_amount); // Sabab qiymaticomment
            $('#science-agencykpi-edit-form').attr('action', `/agencykpiedit/${id}/edit`);

            // Modalni ko'rsatish
            $('#science-agencykpi-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}

function openEditAgencykpiKpiBallModal(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/tasktresult/${id}/edit`,
        type: 'GET',
        success: function (data) {
            $('#ball').val(data.ball); // Sana qiymati

            $('#science-agencykpi-edit-form').attr('action', `/tasktresult/${id}`);

            $('#science-agencykpi-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}


function openEditModalInitiative(id) {
    // AJAX so'rovni yuboramiz
    $.ajax({
        url: `/initiative/${id}`,
        type: 'GET',
        success: function (data) {
            // Ma'lumotlarni modal shaklida aks ettiramiz
            $('#name').val(data.name); // Sana qiymati
            $('#comment').val(data.comment); // Sabab qiymaticomment
            $('#science-paper-edit-form').attr('action', `/initiative/${id}`);

            // Modalni ko'rsatish
            $('#science-paper-edit-modal').modal('show');
        },
        error: function (error) {
            console.error("Ma'lumotlarni yuklashda xatolik yuz berdi: ", error);
        }
    });
}



