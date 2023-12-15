import { createStore } from 'vuex'

const store = createStore({
    state:
    {
        keys : null,
    },
    
    getters:
    {

    },
    
    mutations:
    {
        SET_KEYS(state, newKeys)
        {
            state.keys = newKeys
        },
    },
    
    actions:
    {
        
    }
})

export default store