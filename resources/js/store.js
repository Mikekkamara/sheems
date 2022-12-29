import axios from "axios"

export default{
    state: {
        types: [
            'Data Analyst',
            'Keyboardist',
            'Worship Leader',
            'Violinist'
        ],
        titles: [
            'none',
            'Pastor',
            'Overseer',
            'Bishop'
        ],
        /**
         * Users
         */
        users: [],
        usersSearch: [],
        lastClocked: {

        },

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
        titles(state) {
            return state.titles;
        },
        latest(state) {
            return state.lastClocked;
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
            console.log('reset')
        },
        setLatest(state, payload) {
            state.lastClocked = state.users.find(user => user.id === payload);
        },
        filter(state, payload) {
            state.users = state.usersSearch;

            if (payload.shiftA !== payload.shiftB) {
                try {

                    if ((payload.shiftA === false && payload.shiftB === true)) {
                        let shiftBId = state.shifts.keyboardists.find(shift => shift.name === 'Shift B').id;
                        state.users = state.users.filter(user => user.shift_id === shiftBId);
                    }
                    if ((payload.shiftA === true && payload.shiftB === false)) {
                        let shiftAId = state.shifts.keyboardists.find(shift => shift.name === 'Shift A').id;
                        state.users = state.users.filter(user => user.shift_id === shiftAId);
                    }
                } catch (error) {
                    return true;
                }
            }
            if (payload.checkedIn !== payload.absent) {
                if (payload.checkedIn === false && payload.absent === true) {
                    state.users = state.users.filter(user => {
                        return user.attendances.find(attendance => attendance.start === null && attendance.end === null);
                    });
                }
                if (payload.checkedIn === true && payload.absent === false) {

                    state.users = state.users.filter(user => {
                        return user.attendances.find(attendance => attendance.start !== null && attendance.end == null);
                    });
                }
            }

            let searchUsers = localStorage.getItem('search');

            if (searchUsers) {
                state.users = state.users.filter(user => user.name.toLowerCase().indexOf(searchUsers.toLowerCase()) >= 0);
            }
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
        async deleteUser(context, payload) {
            return await axios.post('/api/v1/users/delete', {user_id:payload.user_id}).then(response => {

                context.dispatch('getUsers', payload.type? payload.type: undefined);
                return response;
            });
        },
        //Get users from api
        async getUsers(context, payload = undefined) {
            if (payload) {

                return await axios.get(`/api/v1/users/${payload}`).then(response => {
                    context.commit('setUsers', response.data);
                });
            }
            return await axios.get('/api/v1/users').then(response => {
                context.commit('setUsers', response.data);
            });
        },
        async updateProfilePicture(context, payload) {
            return await axios.post('/api/v1/users/profile', payload).then(response => {
                return response.data;
            }).catch(error => error);
        },


        //Create a new user
        async createUser(context, payload){
            return await axios.post('/api/v1/users/create', payload, { headers: { "Content-Type" : "multipart/form-data" } }).then(response => {
                return response;
            });
        },

        //Update profile
        async updateProfile(context, payload){
            return await axios.post(`/api/v1/users/update/${payload.id}`, payload.data,{ headers: { "Content-type":"multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2) } }).then(response => {
                // console.log(response.data);
                return response;
            })
        },
        async checkIn(context, payload){
            return await axios.get(`/api/v1/users/check-in/${payload}`).then(async res => {
                context.commit('setLatest', payload);
                return res;
            });
        },
        async checkOut(context, payload){
            return await axios.get(`/api/v1/users/check-out/${payload}`).then(async res => {
                context.commit('setLatest', payload);
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
