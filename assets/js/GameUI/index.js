import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import { createStore } from 'redux'
import arena from './reducers/arena'
import GameUI from "./GameUI";
import { combineReducers } from 'redux'

const gameUI = combineReducers({ arena })
const store = createStore(gameUI)

render(
    <Provider store={store}>
        <GameUI />
    </Provider>,
    document.getElementById('game')
)