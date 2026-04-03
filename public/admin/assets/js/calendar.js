(function (factory) {
    typeof define === 'function' && define.amd ? define(factory) :
        factory();
})((function () {
    'use strict';

    const appCalendarInit = () => {
        const apiUrl = '/events'; // The Laravel route URL that returns the JSON data

        // Function to fetch events
        const fetchEvents = async () => {
            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json(); // Parse JSON from the response


                const getButtonClass = (status) => {
                    switch (status) {
                        case 'new':
                            return 'text-success text-white';
                        case 'exited':
                            return 'text-danger text-white';
                        case 'queue':
                            return 'text-warning text-white';
                        case 'rejected':
                            return 'text-danger text-white';
                        default:
                            return 'text-primary text-white';
                    }
                };

                // Map the data to FullCalendar's expected format
                return data.data.map(event => ({
                    title: event.fish,
                    masala: event.title,
                    start: event.start,
                    end: event.end || null, // Use null if no end date
                    description: event.description,
                    kimga: event.kimga,
                    fish: event.fish,
                    status: event.status,
                    tuzilma: event.tuzilma,
                    answer: event.answer,
                    // className: `text-${event.status === 'rejected' ? 'danger' : 'success'}`, // Add dynamic styling based on status
                    className:  getButtonClass(event.status),

                }));
            } catch (error) {
                console.error('Failed to fetch events:', error);
                return []; // Return an empty array on failure
            }
        };

        // Initialize FullCalendar
        fetchEvents().then(events => {
            const calendarElement = document.querySelector('#appCalendar');
            if (calendarElement) {
                const calendar = new window.FullCalendar.Calendar(calendarElement, {
                    initialView: 'dayGridMonth',
                    height: 800,
                    locale: 'uz',
                    dayHeaderContent: function(info) {
                        const days = ['Yakshanba', 'Dushanba', 'Seshanba', 'Chorshanba', 'Payshanba', 'Juma', 'Shanba'];
                        return days[info.date.getDay()];
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title', // Sarlavhada oy va yil ko‘rsatiladi
                        right: 'dayGridMonth,timeGridWeek,timeGridDay',
                    },
                    buttonText: {
                        today: "Bugun",
                        month: "Oy",
                        week: "Hafta",
                        day: "Kun",
                        list: "Ro'yxat"
                    },
                    events: events, // Use the fetched events here
                    eventClick: (e) => {
                        if (e.event.url) {
                            window.open(e.event.url, "_blank");
                            e.jsEvent.preventDefault();
                        } else {
                            // Handle event details modal
                            const modalContent = getTemplate(e.event); // Assuming `getTemplate` is a function you use for modals
                            document.querySelector('#eventDetailsModal .modal-content').innerHTML = modalContent;
                            new window.bootstrap.Modal(document.querySelector('#eventDetailsModal')).show();
                        }
                    },
                });
                calendar.render(); // Render the calendar
            }
        });
    };

    // Initialize when document is ready
    const { docReady } = window.phoenix.utils;
    docReady(appCalendarInit);

    // Utility function to camelize dataset attributes (for dynamic attributes)
    const camelize = e => {
        const t = e.replace(/[-_\s.]+(.)?/g, ((e, t) => t ? t.toUpperCase() : ""));
        return `${t.substr(0, 1).toLowerCase()}${t.substr(1)}`;
    };

    const getData = (e, t) => {
        try {
            return JSON.parse(e.dataset[camelize(t)]);
        } catch (o) {
            return e.dataset[camelize(t)];
        }
    };

    const getTemplate = n => {
        // Template for event details modal
        return `
      <div class="modal-header ps-card border-bottom border-translucent justify-content-between p-0">
        <div class="modal-dialog modal-dialog-centered" style="width: 100%;margin: 0;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticallyCenteredModalLabel">Ma'lumotlarni ko'rish</h5>
                    <button class="btn btn-close p-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        <div class="w-full  sm:mt-0 sm:ml-auto md:ml-0">
                            <table class="table" style="border-radius: 8px;">
                                <tbody>
                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;"> Kimga?
                                        </th>
                                        <td class="border" style="width:60%;color:black;" id="kimningqabulga">${ n.extendedProps.kimga }</td>
                                    </tr>
                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;"> Holati
                                        </th>
                                        <th class="border" style="width:60%;color:black;">
                                            <button type="button" id="status_tus"
                                                class="button delete-cancel  mr-1 ${getStatusButton(n.extendedProps.status)}">
                                                 ${getStatusText(n.extendedProps.status)}
                                                </button>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;"> F.I.O
                                        </th>
                                        <td class="border" style="width:60%;color:black;" id="user">${ n.extendedProps.fish }</td>
                                    </tr>
                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;"> Tarkibiy bo'linma
                                        </th>
                                        <td class="border" style="width:60%;color:black;" id="bulim">${ n.extendedProps.tuzilma }</td>
                                    </tr>
                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;"> Masala</th>
                                        <td class="border" style="width:60%;color:black;" id="nomi">${ n.extendedProps.masala }</td>
                                    </tr>
                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;"> Kuni</th>
                                        <td class="border" style="width:60%;color:black;" id="day_date">
                                            ${window.dayjs(n.start).format("MMMM D, YYYY, h:mm A")}
                                            ${n.end ? `– ${window.dayjs(n.end).format("h:mm A")}` : ""}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;">Rahbar tomonidan berilgan topshiriq va bajarish muddati</th>
                                        <td class="border" style="width:60%;color:black;" id="comment_ment">${ n.extendedProps.description }</td>
                                    </tr>
                                    <tr>
                                        <th class="border"
                                            style="width:40%;background-color: rgba(0, 0, 0, 0.02);color:black;"> Javob
                                        </th>
                                        <td class="border" style="width:60%;color:black;" id="answer">${ n.extendedProps.answer ?? "-"}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
      </div>
    `;
    };

    const getStatusText = (status) => {
        switch (status) {
            case 'new':
                return 'Yangi';
            case 'exited':
                return 'Yakunlangan';
            case 'queue':
                return 'Navbatda';
            case 'rejected':
                return 'Rad etildi';
            default:
                return 'Qabulda';
        }
    };

    const getStatusButton = (status) => {
        switch (status) {
            case 'new':
                return 'btn btn-subtle-warning';
            case 'exited':
                return 'btn btn-subtle-secondary';
            case 'queue':
                return 'btn btn-subtle-info';
            case 'rejected':
                return 'btn btn-subtle-danger';
            default:
                return 'btn btn-subtle-success';
        }
    };

}));
