import { connect } from 'react-redux'
import {loadStage} from '../actions/arena'
import Arena from '../components/Arena'

const mapStateToProps = (state, ownProps) => {

    return {
        arena: state.arena
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        loadStage: dispatch(loadStage())
    }
}

const ArenaContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(Arena)

export default ArenaContainer