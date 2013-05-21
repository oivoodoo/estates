require 'spec_helper'

describe ProjectsController do
	describe 'get #index' do
		context 'with project' do
			let!(:projects) { 2.times.map { create(:project) } }

	    before { get :index }
	    
	    it { should respond_with(:success) }
	  
		  it 'should pick up items' do
		    collection = assigns(:projects) 
			  expect(collection).to have(2).items
			  expect(collection).to include(projects[0])
			  expect(collection).to include(projects[1])
			end
		end

		describe 'get #show' do
			context 'with project' do
				let!(:project) { create(:project) }

				before { get :show, id: project.to_param }

				it { should respond_with(:success) }

				it { expect(assigns(:project)).to eq(project) }
			end

			context 'without project' do
				before { get :show, id: 'invalid id' }

				it { should respond_with(404) }
			end
		end
	end
end
