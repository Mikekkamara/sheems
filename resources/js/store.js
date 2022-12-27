import axios from "axios"

export default{
    state: {
        types: [
            'Data Analyst',
            'Keyboardist',
            'Worship Leader',
            'Violinist'
        ],
        /**
         * Users
         */
        users: [],
        usersSearch: [],

        /**
         * Shifts
         */
        shifts: [],
        sessions:{
            shiftId: '',
            data: [],
            users: []
        }
    },
    getters: {
        csrfToken(){
            return window.Laravel.csrfToken;
        },
        userTypes(state) {
            return state.types;
        },
        /**
         * Users
         */
        allUsers(state){
            return state.users;
        },

        /**
         * Shifts
         */
        allShifts(state){
            return state.shifts;
        },
        //Get ongoing shift
        ongoingShifts(state) {
            let keyboardists = state.shifts.keyboardists.find(shift => shift.ongoing_session_keyboardists !== null);
            let worship_leaders = state.shifts.worship_leaders.find(shift => shift.ongoing_session_worship_leaders !== null);
            let violinists = state.shifts.violinists.find(shift => shift.ongoing_session_violinists !== null);

            return {
                keyboardists,
                worship_leaders,
                violinists
            };
        },
        sessions(state){
            return state.sessions.data;
        },
        sessionsUsers(state){
            return state.sessions.users
        }
    },
    mutations: {
        /**
         * Users
         */
        //Mutate users
        setUsers(state, payload){
            state.users = payload;
            state.usersSearch = payload;
        },
        searchUsers(state, payload) {
            state.users = state.users.filter(user => user.name.toLowerCase().indexOf(payload.toLowerCase()) >= 0);
        },
        resetSearch(state) {
            state.users = state.usersSearch;
        },

        /**
         * Shifts
         */
        //Mutate Shifts
        setShifts(state, payload){
            state.shifts = payload;
        },
        setSessions(state, payload){
            state.sessions.shiftId = payload.id;
            state.sessions.data = payload.sessions;
            state.sessions.users = payload.users;
        }
    },
    actions: {
        /**
         * Users
         */
        //Get users from api
        async getUsers(context, payload = undefined) {
            if (payload) {

                return await axios.get(`/api/v1/user/${payload}`).then(response => {
                    context.commit('setUsers', response.data);
                });
            }
            return await axios.get('/api/v1/user').then(response => {
                context.commit('setUsers', response.data);
            });
        },


        //Create a new user
        async createUser(context, payload){
            return await axios.post('/api/v1/user/create', payload, { headers: { "Content-Type" : "multipart/form-data" } }).then(response => {
                return response;
            });
        },

        //Update profile
        async updateProfile(context, payload){
            return await axios.post(`/api/v1/user/update/${payload.id}`, payload.data,{ headers: { "Content-type":"multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2) } }).then(response => {
                // console.log(response.data);
                return response;
            })
        },
        checkIn(context, payload){
            return axios.get(`/api/v1/user/check-in/${payload}`).then(res => {
                context.dispatch('getUsers');
                context.dispatch('getShifts');
                return res;
            });
        },
        checkOut(context, payload){
            return axios.get(`/api/v1/user/check-out/${payload}`).then(res => {
                context.dispatch('getUsers');
                context.dispatch('getShifts');
                return res;
            });
        },
        /**
         * Shifts
         */
        //Get shifts from api
        getShifts(context){
            return axios.get('/api/v1/shift').then(response => {
                context.commit('setShifts', response.data);
            });
        },

        //Get sessions
        getSessions(context, payload){
            return axios.get(`/api/v1/shift/sessions/${payload}`).then(response => {
                context.commit('setSessions', response.data);
            })
        },

        //end Shift
        endShift(context, payload){
            return axios.get(`/api/v1/shift/end/${payload.shiftId}/${payload.type}`).then(response => response).catch(error => error);
        },

        //Start Shift
        startShift(context, payload){
            return axios.get(`/api/v1/shift/start/${payload.shiftId}/${payload.type}`).then(response => response).catch(error => error);
        },

        //end and go to next shift
        goToNext(context, payload){
            return axios.get(`/api/v1/shift/end-and-go-to-next/${payload.shiftId}/${payload.nextId}/${payload.type}`).then(response => response).catch(error => error);
        }
    }
};
