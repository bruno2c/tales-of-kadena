import React from 'react'
import EnemyContainer from "../containers/EnemyContainer";
import ChampionContainer from "../containers/ChampionContainer";
import {UI_SIDE_ENEMIES} from "../constants/UIConstants";

class Arena  extends React.Component {

    constructor(props) {
        super(props);
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (this.props.currentSide === UI_SIDE_ENEMIES) {
            this.props.enemyAct();
        }
    }

    render() {
        return (
            <div className={"arena"}>

                <div className={"champions-side"}>
                    {Object.keys(this.props.arena.champions).map(key => (
                        <ChampionContainer key={key} champion={this.props.arena.champions[key]}/>
                    ))}
                </div>

                <div className={"enemies-side"}>
                    {Object.keys(this.props.arena.enemies).map(key => (
                        <EnemyContainer key={key} enemy={this.props.arena.enemies[key]}/>
                    ))}
                </div>
            </div>
        )
    }
}

export default Arena