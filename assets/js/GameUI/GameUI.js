import React from 'react'
import ArenaContainer from './containers/ArenaContainer'
import UIContainer from './containers/UIContainer'

class GameUI extends React.Component {
    render() {
        return (
            <div>
                <ArenaContainer />
                <UIContainer />
            </div>
        )
    }
}

export default GameUI;