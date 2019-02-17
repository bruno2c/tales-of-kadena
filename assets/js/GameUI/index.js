import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import { createStore, applyMiddleware, compose } from 'redux'
import arena from './reducers/arena'
import game from './reducers/game'
import GameUI from "./GameUI";
import { combineReducers } from 'redux'
import thunk from 'redux-thunk'

const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

const gameUI = combineReducers({ game, arena })

const store = createStore(
    gameUI,
    composeEnhancers(
        applyMiddleware(thunk)
    ),
)

render(
    <Provider store={store}>
        <GameUI />
    </Provider>,
    document.getElementById('game')
)