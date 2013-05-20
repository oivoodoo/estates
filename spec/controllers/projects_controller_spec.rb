require 'spec_helper'

describe ProjectsController do
	context "on show projects page" do
		context "with existing project" do
			describe '#index' do
		    before { get :index }
		    
		    it { should respond_with(:success) }
		    it { assigns(:project).should == @project }
		  end
		end
	end
end
