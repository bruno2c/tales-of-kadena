import { connect } from 'react-redux'
import { loadStage, enemyAct } from '../actions/arena'
import Arena from '../components/Arena'

const mapStateToProps = (state, ownProps) => {

    return {
        arena: state.arena,
        currentSide: state.ui.currentSide,
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        loadStage: dispatch(loadStage()),
        enemyAct: () => dispatch(enemyAct())
    }
}

const ArenaContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(Arena)

export default ArenaContainer